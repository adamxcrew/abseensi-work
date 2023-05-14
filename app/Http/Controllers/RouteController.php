<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\EmployeeProfile;
use App\Models\PersonalProfile;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class RouteController extends Controller
{
    protected $getDatesInThisMonth = [];
    protected $getMonthInThisYear = [];

    public function __construct()
    {
        $this->getDatesInThisMonth = $this->getDatesInThisMonth();
        $this->getMonthInThisYear = $this->getMonthInThisYear();
    }

    public function getDatesInThisMonth()
    {
        $days = [];

        for ($i = 1; $i <= date('t'); $i++) {
            $days[] = $i;
        }

        return $days;
    }

    public function getMonthInThisYear()
    {
        $months = [];

        for ($i = 1; $i <= 12; $i++) {
            $months[] = $i;
        }

        return $months;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dashboard()
    {
        $datePicked = request()->date ?? date('Y-m');
        $datePickedFormated = Carbon::parse($datePicked)->format('F Y');
        $yearDatePickedFormated = Carbon::parse($datePicked)->format('Y');
        $today = date('d F Y');

        // ambil data attendance dan digroup berdasarkan employee_id dan distinct
        $attendances = Attendances::distinct()
        ->whereYear('presence_date', date('Y', strtotime($datePicked)))
        ->whereMonth('presence_date', date('m', strtotime($datePicked)))
        ->when(Auth::user()->role == 'teacher', function ($query) {
            return $query->where('employee_id', Auth::user()->employee->id);
        })
        ->get()->groupBy('employee.user.fullname');

        // all attendance today
        $attendancesToday = Attendances::distinct()
        ->whereDate('presence_date', date('Y-m-d'))
        ->when(Auth::user()->role == 'teacher', function ($query) {
            return $query->where('employee_id', Auth::user()->employee->id);
        })
        ->get();

        // memuat semua detail karyawan
        $employees = EmployeeProfile::all(['id', 'user_id', 'employee_tier'])->keyBy('id');

        $officerLevel = User::select(
            DB::raw("SUM(CASE WHEN role = 'admin' THEN 1 ELSE 0 END) as admin_total"),
            DB::raw("SUM(CASE WHEN role = 'tu' THEN 1 ELSE 0 END) as tu_total"),
            DB::raw("SUM(CASE WHEN role = 'teacher' THEN 1 ELSE 0 END) as teacher_total"),
            DB::raw("COUNT(*) as total_users")
        )->first();

        $statsOfficer = EmployeeProfile::select(
            DB::raw("SUM(CASE WHEN employee_stats = 'tetap' THEN 1 ELSE 0 END) as tetap_total"),
            DB::raw("SUM(CASE WHEN employee_stats = 'kontrak' THEN 1 ELSE 0 END) as kontrak_total"),
            DB::raw("COUNT(*) as total_employee")
        )
        ->first();

        $gendersOfficer = PersonalProfile::select(
            DB::raw("SUM(CASE WHEN gender = 'male' THEN 1 ELSE 0 END) as male_total"),
            DB::raw("SUM(CASE WHEN gender = 'female' THEN 1 ELSE 0 END) as female_total"),
            DB::raw("COUNT(*) as total_personal")
        )
        ->first();

        $totalEmployeePerMonth = User::select(DB::raw("DATE_FORMAT(created_at, '%m') as month"), DB::raw('count(*) as total_users'))
        ->whereYear('created_at', date('Y', strtotime($datePicked)))
        ->groupBy('month')
        ->get();

        $officerLevelData = [
            'admin' => [
                'total' => $officerLevel->admin_total,
                'persentase' => intval(($officerLevel->admin_total / $officerLevel->total_users) * 100)
            ],
            'tu' => [
                'total' => $officerLevel->tu_total,
                'persentase' => intval(($officerLevel->tu_total / $officerLevel->total_users) * 100)
            ],
            'teacher' => [
                'total' => $officerLevel->teacher_total,
                'persentase' => intval(($officerLevel->teacher_total / $officerLevel->total_users) * 100)
            ]
        ];

        $statsOfficerData = [
            'tetap' => [
                'total' => $statsOfficer->tetap_total,
                'persentase' => intval(($statsOfficer->tetap_total / $statsOfficer->total_employee) * 100)
            ],
            'kontrak' => [
                'total' => $statsOfficer->kontrak_total,
                'persentase' => intval(($statsOfficer->kontrak_total / $statsOfficer->total_employee) * 100)
            ],
        ];

        $gendersOfficerData = [
            'male' => [
                'total' => $gendersOfficer->male_total,
                'persentase' => intval(($gendersOfficer->male_total / $gendersOfficer->total_personal) * 100)
            ],
            'female' => [
                'total' => $gendersOfficer->female_total,
                'persentase' => intval(($gendersOfficer->female_total / $gendersOfficer->total_personal) * 100)
            ],
        ];


        $datesInThisMonth = $this->getDatesInThisMonth;
        $monthInThisYear = $this->getMonthInThisYear;

        $attendanceDataByDate = [];
        $attendanceCount = [
            'hadir' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'izin' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'sakit' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'alpa' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'cuti' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'total' => [
                'total'=> 0,
                'employee_id' => [],
            ],
            'dinas_luar' => [
                'total'=> 0,
                'employee_id' => [],
            ],
        ];

        foreach ($attendances as $attendanceKey => $attendance) {
            foreach ($datesInThisMonth as $dateInMonth) {
                $attendanceDataByDate[$attendanceKey][$dateInMonth] = null;

                foreach ($attendance as $attendanceValue) {
                    if ($attendanceValue->presence_date->format('d') == $dateInMonth) {

                        if($attendanceValue->clock_out){
                            $attendanceDataByDate[$attendanceKey][$dateInMonth] = $attendanceValue->presence_status;
                        }
                    }
                }
            }
        }

        $totalEmployeePerMonthData = [];
        foreach($monthInThisYear as $month){
            $totalEmployeePerMonthData[$month] = 0;

            foreach($totalEmployeePerMonth as $totalEmployee){
                if($totalEmployee->month == $month){
                    $totalEmployeePerMonthData[$month] = $totalEmployee->total_users;
                }
            }
        }

        foreach ($attendancesToday as $key => $valueAttendanceToday) {
            $valueAttendanceToday->presence_status = strtolower($valueAttendanceToday->presence_status);

            switch ($valueAttendanceToday->presence_status) {
                case 'hadir':
                    $attendanceCount['hadir']['total']++;
                    array_push($attendanceCount['hadir']['employee_id'], $valueAttendanceToday->employee_id);
                    $attendanceCount['total']['total']++;
                    array_push($attendanceCount['total']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    break;
                case 'izin':
                    $attendanceCount['izin']['total']++;
                    array_push($attendanceCount['izin']['employee_id'], $valueAttendanceToday->employee_id);
                    $attendanceCount['total']['total']++;
                    array_push($attendanceCount['total']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    break;
                case 'sakit':
                    $attendanceCount['sakit']['total']++;
                    array_push($attendanceCount['sakit']['employee_id'], $valueAttendanceToday->employee_id);
                    $attendanceCount['total']['total']++;
                    array_push($attendanceCount['total']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    break;
                case 'alpa':
                    if ($employees->has($valueAttendanceToday->employee_id)) {
                        $attendanceCount['alpa']['total']++;
                        array_push($attendanceCount['alpa']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    } else {
                        $attendanceCount['alpa']['total']++;
                        array_push($attendanceCount['alpa']['employee_id'], $valueAttendanceToday->employee_id);
                    }
                    $attendanceCount['total']['total']++;
                    break;
                case 'cuti':
                    if ($employees->has($valueAttendanceToday->employee_id)) {
                        $attendanceCount['cuti']['total']++;
                        array_push($attendanceCount['cuti']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    } else {
                        $attendanceCount['cuti']['total']++;
                        array_push($attendanceCount['cuti']['employee_id'], $valueAttendanceToday->employee_id);
                    }
                    $attendanceCount['total']['total']++;
                    break;
                case 'dinas_luar':
                    if ($employees->has($valueAttendanceToday->employee_id)) {
                        $attendanceCount['dinas_luar']['total']++;
                        array_push($attendanceCount['dinas_luar']['employee_id'], $employees[$valueAttendanceToday->employee_id]->user);
                    } else {
                        $attendanceCount['dinas_luar']['total']++;
                        array_push($attendanceCount['dinas_luar']['employee_id'], $valueAttendanceToday->employee_id);
                    }
                    $attendanceCount['total']['total']++;
                    break;
            }

            if (!$valueAttendanceToday->clock_in && !$valueAttendanceToday->clock_out) {
                $attendanceCount['alpa']['total']++;
                array_push($attendanceCount['alpa']['employee_id'], $valueAttendanceToday->employee_id);
                $attendanceCount['total']['total']++;
            }
        }

        $hasScheduleToday = Attendances::where('employee_id', Auth::user()->employee->id)
                ->whereDate('presence_date', date('Y-m-d'))
                ->first() ?? null;

        return view('dashboard.index', compact('attendances', 'datesInThisMonth', 'attendanceDataByDate', 'attendanceCount', 'datePicked', 'hasScheduleToday', 'datePickedFormated', 'officerLevelData', 'statsOfficerData', 'gendersOfficerData', 'totalEmployeePerMonthData', 'yearDatePickedFormated', 'today'));

    }
}
