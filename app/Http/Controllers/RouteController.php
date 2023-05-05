<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use App\Models\EmployeeProfile;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        $monthPicked = explode('-', $datePicked)[1];
        $yearPicked = explode('-', $datePicked)[0];

        // get attendances group by employee_id
        $attendances = Attendances::selectRaw('employee_id, GROUP_CONCAT(presence_date) as attendance_date, GROUP_CONCAT(presence_status) as attendance_status')
            ->groupBy('employee_id')
            ->whereMonth('presence_date', $monthPicked)
            ->whereYear('presence_date', $yearPicked);

        if (Auth::user()->role == 'teacher') {
            $attendances = $attendances->where('employee_id', Auth::user()->employee?->id);
        }

        $attendances = $attendances->get();

        // get dates in this month
        $datesInThisMonth = $this->getDatesInThisMonth;

        $attendanceDataByDate = [];
        foreach ($attendances as $attendanceKey => $attendance) {
            foreach ($datesInThisMonth as $dateInMonth) {
                $attendanceDataByDate[$attendanceKey][$dateInMonth] = null;

                $attendanceDate = explode(',', $attendance->attendance_date);
                $attendanceStatus = explode(',', $attendance->attendance_status);

                foreach ($attendanceDate as $key => $date) {
                    if ($dateInMonth == date('j', strtotime($date))) {
                        $attendanceDataByDate[$attendanceKey][$dateInMonth] = $attendanceStatus[$key];
                    }
                }
            }
        }

        // change key to employee_id
        $attendanceDataByDate = array_combine(array_column($attendances->toArray(), 'employee_id'), $attendanceDataByDate);

        $employees = EmployeeProfile::with('user:id,fullname')->whereHas('attendances')->get(['id', 'user_id']);

        $attendanceCount = [
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'alpa' => 0,
            'cuti' => 0,
            'total' => 0
        ];

        foreach ($attendanceDataByDate as $attendance) {
            foreach ($attendance as $status) {
                $status = strtolower($status);
                if ($status == 'hadir') {
                    $attendanceCount['hadir']++;
                } elseif ($status == 'izin') {
                    $attendanceCount['izin']++;
                } elseif ($status == 'sakit') {
                    $attendanceCount['sakit']++;
                } elseif ($status == 'alpa') {
                    $attendanceCount['alpa']++;
                } elseif ($status == 'cuti') {
                    $attendanceCount['cuti']++;
                }
            }
        }

        $attendanceCount['total'] = $attendanceCount['hadir'] + $attendanceCount['izin'] + $attendanceCount['sakit'] + $attendanceCount['alpa'] + $attendanceCount['cuti'];

        return view('dashboard.index', compact('attendances', 'datesInThisMonth', 'attendanceDataByDate', 'employees', 'attendanceCount', 'datePicked'));

    }
}
