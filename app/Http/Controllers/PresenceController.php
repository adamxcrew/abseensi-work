<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class PresenceController extends Controller
{
    public function index()
    {
        return view('dashboard.presences.index');
    }

    public function create(Request $request)
    {
        $presences_type = $request->presences_type;
        return view('dashboard.presences.create', compact('presences_type'));
    }

    public function postImage(Request $request)
    {
        $attendance_image = $request->attendance_image;
        $attendance_date_clock = $request->attendance_date_clock;
        $attendance_longitude_lat = $request->attendance_longitude_lat;
        $presences_type = $request->presences_type;

        return view('dashboard.presences.post-attendance', compact('attendance_image', 'attendance_date_clock', 'attendance_longitude_lat', 'presences_type'));
    }

    public function store(Request $request)
    {
        $payload = [
            'employee_id' => Auth::user()->employee->id,
            'presence_date' => date('Y-m-d'),
            'presence_status' => $request->presence_status,
            'presence_desc' => $request->presence_desc,
        ];

        // convert image to file
        $image = $request->attendance_image;
        $image = str_replace('data:image/png;base64,', '', $image);
        $image = str_replace(' ', '+', $image);
        $imageName = 'presences-'.time().'.'.'png';
        File::put(public_path(). '/uploads/images/' . $imageName, base64_decode($image));

        if ($request->presences_type == 'absen_masuk') {
            $payload['clock_in'] = explode(' ', $request->attendance_date_clock)[1];
            $payload['location_in'] = $request->attendance_longitude_lat;
            $payload['presence_pict_in'] = $imageName;
        }else{
            $payload['clock_out'] = explode(' ', $request->attendance_date_clock)[1];
            $payload['location_out'] = $request->attendance_longitude_lat;
            $payload['presence_pict_out'] = $imageName;
        }

        Attendances::updateOrCreate([
            'employee_id' => $payload['employee_id'],
            'presence_date' => $payload['presence_date'],
        ], $payload);

        return redirect(route('home'))->with('success', 'Berhasil absensi');
    }
}
