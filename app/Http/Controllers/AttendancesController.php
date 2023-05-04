<?php

namespace App\Http\Controllers;

use App\Models\Attendances;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateAttendances;
use Illuminate\Support\Facades\Hash;

class AttendancesController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $attendances = Attendances::orderByDesc('id');
        $attendances = $attendances->paginate(50);

        return view('dashboard.attendances.index', compact('attendances'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.attendances.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateAttendances $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $attendances = Attendances::create($validated);

        return redirect(route('attendances.index'))->with('success', 'Presensi berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return Attendances::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $attendances = Attendances::findOrFail($id);

        return view('dashboard.attendances.edit', compact('attendances'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateAttendances $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $attendances = Attendances::findOrFail($id);

        $attendances->update($validated);

        return redirect(route('attendances.index'))->with('success', 'Presensi berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $attendances = Attendances::findOrFail($id);

        $attendances->delete();

        return redirect(route('attendances.index'))->with('success', 'Presensi berhasil dihapus.');
    }
}
