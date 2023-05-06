<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateSubmission;
use App\Models\EmployeeProfile;
use App\Models\TimeOffSetting;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;

class SubmissionController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $submissions = Submission::orderByDesc('id');

        if (Auth::user()->role == 'teacher') {
            $submissions = $submissions->where('employee_id', Auth::user()->employee->id);
        }

        $submissions = $submissions->paginate(50);

        return view('dashboard.submissions.index', compact('submissions'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $employees = EmployeeProfile::whereHas('user', function ($query) {
            $query->where('role' , '!=', 'admin');
        })->get();

        $timeoffs = TimeOffSetting::all(['id', 'description_timeoff', 'code_timeoff']);

        return view('dashboard.submissions.create', compact('employees', 'timeoffs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateSubmission $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        // hitung total hari dari start_timeoff sampai end_timeoff menggunakan carbon
        $start_timeoff = \Carbon\Carbon::parse($request->start_timeoff);
        $end_timeoff = \Carbon\Carbon::parse($request->finish_timeoff);

        $totalDayTimeoff = $start_timeoff->diffInDays($end_timeoff);

        // ambil timeoff setting berdasarkan code_timeoff
        $timeoff = TimeOffSetting::whereId($request->submission_type)->first();

        if (is_null($timeoff)) {
            return redirect(route('submissions.create'))->with('error', 'Tipe cuti tidak ditemukan.');
        }

        // durasi cuti
        $duration = $timeoff->durasi_timeoff;

        // cek apakah durasi cuti lebih dari total hari cuti
        if ($duration < $totalDayTimeoff) {
            return redirect(route('submissions.create'))->with('error', 'Durasi cuti tidak boleh lebih dari total hari cuti.');
        }

        if($request->hasFile('submission_file')){
            $fileName = time() . '.' . $request->submission_file->extension();
            $validated['submission_file'] = $fileName;

            // move file
            $request->submission_file->move(public_path('uploads/submission_files'), $fileName);
        }

        $submissions = Submission::create($validated);

        return redirect(route('submissions.index'))->with('success', 'Permohonan cuti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $submission = Submission::whereUuid($id)->firstOrFail();

        return view('dashboard.submissions.show', compact('submission'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $submissions = Submission::findOrFail($id);

        return view('dashboard.submissions.edit', compact('submissions'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validated = [
            'submission_status' => $request->submission_status,
            'updated_at' => now(),
        ];

        $submissions = Submission::whereUuid($id)->firstOrFail();

        $submissions->update($validated);

        return redirect(route('submissions.index'))->with('success', 'Permohonan cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($uuid)
    {
        $submissions = Submission::whereUuid($uuid)->firstOrFail();

        $submissions->delete();

        return redirect(route('submissions.index'))->with('success', 'Permohonan cuti berhasil dihapus.');
    }

    public function conditions()
    {
        $timeoff = TimeOffSetting::orderByDesc('id');
        $timeoff = $timeoff->paginate(50);

        return view('dashboard.submissions.conditional', compact('timeoff'));
    }
}
