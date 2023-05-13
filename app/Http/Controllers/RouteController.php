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

        // ambil data attendance dan digroup berdasarkan employee_id dan distinct
        $attendances = Attendances::distinct()
        ->whereYear('presence_date', date('Y', strtotime($datePicked)))
        ->whereMonth('presence_date', date('m', strtotime($datePicked)))
        ->when(Auth::user()->role == 'teacher', function ($query) {
            return $query->where('employee_id', Auth::user()->employee->id);
        })
        ->whereNotNull('clock_out')
        ->get()->groupBy('employee.user.fullname');


        $datesInThisMonth = $this->getDatesInThisMonth;

        $attendanceDataByDate = [];
        $attendanceCount = [
            'hadir' => 0,
            'izin' => 0,
            'sakit' => 0,
            'alpa' => 0,
            'cuti' => 0,
            'total' => 0,
        ];

        foreach ($attendances as $attendanceKey => $attendance) {
            foreach ($datesInThisMonth as $dateInMonth) {
                $attendanceDataByDate[$attendanceKey][$dateInMonth] = null;

                foreach ($attendance as $attendanceValue) {
                    if ($attendanceValue->presence_date->format('d') == $dateInMonth) {
                        $attendanceDataByDate[$attendanceKey][$dateInMonth] = $attendanceValue->presence_status;

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
                        }
                    }
                }
            }

            $attendanceCount['total'] = $attendanceCount['hadir'] + $attendanceCount['izin'] + $attendanceCount['sakit'] + $attendanceCount['alpa'] + $attendanceCount['cuti'];

            foreach ($datesInThisMonth as $dateInMonth) {
                $attendanceDataByDate[$attendanceKey][$dateInMonth] = null;
                foreach ($attendance as $attendanceValue) {
                    if ($attendanceValue->presence_date->format('d') == $dateInMonth) {
                        $attendanceDataByDate[$attendanceKey][$dateInMonth] = $attendanceValue->presence_status;
                    }
                }
            }
        }

        $hasScheduleToday = Attendances::where('employee_id', Auth::user()->employee->id)
                ->whereDate('presence_date', date('Y-m-d'))
                ->first() ?? null;

        return view('dashboard.index', compact('attendances', 'datesInThisMonth', 'attendanceDataByDate', 'attendanceCount', 'datePicked', 'hasScheduleToday'));

    }
}
