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

    public function __construct()
    {
        $this->getDatesInThisMonth = $this->getDatesInThisMonth();
    }

    public function getDatesInThisMonth()
    {
        $days = [];

        for ($i = 1; $i <= date('t'); $i++) {
            $days[] = $i;
        }

        return $days;
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

        // ambil data attendance dan digroup berdasarkan employee_id dan distinct
        $attendances = Attendances::distinct()
        ->whereYear('presence_date', date('Y', strtotime($datePicked)))
        ->whereMonth('presence_date', date('m', strtotime($datePicked)))
        ->when(Auth::user()->role == 'teacher', function ($query) {
            return $query->where('employee_id', Auth::user()->employee->id);
        })
        ->get()->groupBy('employee.user.fullname');

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

        $attendanceDataByDate = [];
        $attendanceCount = [
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'alpa' => 0,
            'cuti' => 0,
            'total' => 0,
            'dinas_luar' => 0,
        ];

        foreach ($attendances as $attendanceKey => $attendance) {
            foreach ($datesInThisMonth as $dateInMonth) {
                $attendanceDataByDate[$attendanceKey][$dateInMonth] = null;

                foreach ($attendance as $attendanceValue) {
                    if ($attendanceValue->presence_date->format('d') == $dateInMonth) {

                        if($attendanceValue->clock_out){
                            $attendanceDataByDate[$attendanceKey][$dateInMonth] = $attendanceValue->presence_status;
                        }

                        $attendanceValue->presence_status = strtolower($attendanceValue->presence_status);

                        if ($attendanceValue->presence_status == 'hadir') {
                            $attendanceCount['hadir']++;
                        } elseif ($attendanceValue->presence_status == 'izin') {
                            $attendanceCount['izin']++;
                        } elseif ($attendanceValue->presence_status == 'sakit') {
                            $attendanceCount['sakit']++;
                        } elseif ($attendanceValue->presence_status == 'alpa') {
                            $attendanceCount['alpa']++;
                        } elseif ($attendanceValue->presence_status == 'cuti') {
                            $attendanceCount['cuti']++;
                        } elseif ($attendanceValue->presence_status == 'dinas_luar') {
                            $attendanceCount['dinas_luar']++;
                        }
                    }

                    if (!$attendanceValue->clock_in && !$attendanceValue->clock_out) {
                        $attendanceCount['alpa']++;
                    }
                }
            }

            $attendanceCount['total'] = $attendanceCount['hadir'] + $attendanceCount['izin'] + $attendanceCount['sakit'] + $attendanceCount['alpa'] + $attendanceCount['cuti'];
        }

        $hasScheduleToday = Attendances::where('employee_id', Auth::user()->employee->id)
                ->whereDate('presence_date', date('Y-m-d'))
                ->first() ?? null;

        return view('dashboard.index', compact('attendances', 'datesInThisMonth', 'attendanceDataByDate', 'attendanceCount', 'datePicked', 'hasScheduleToday', 'datePickedFormated', 'officerLevelData', 'statsOfficerData', 'gendersOfficerData'));

    }
}
