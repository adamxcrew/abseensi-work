<?php

namespace App\Http\Controllers;

use App\Models\Submission;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateSubmission;
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
        return view('dashboard.submissions.create');
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
        return Submission::findOrFail($id);
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
    public function update(RequestStoreOrUpdateSubmission $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $submissions = Submission::findOrFail($id);

        $submissions->update($validated);

        return redirect(route('submissions.index'))->with('success', 'Permohonan cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $submissions = Submission::findOrFail($id);

        $submissions->delete();

        return redirect(route('submissions.index'))->with('success', 'Permohonan cuti berhasil dihapus.');
    }
}
