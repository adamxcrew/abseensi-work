<?php

namespace App\Http\Controllers;

use App\Models\TimeOffSetting;
use Illuminate\Http\Request;
use App\Http\Requests\RequestStoreOrUpdateTimeOffSetting;
use Illuminate\Support\Facades\Hash;

class TimeOffSettingController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $timeoff = TimeOffSetting::orderByDesc('id');
        $timeoff = $timeoff->paginate(50);

        return view('dashboard.timeoff.index', compact('timeoff'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('dashboard.timeoff.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(RequestStoreOrUpdateTimeOffSetting $request)
    {
        $validated = $request->validated() + [
            'created_at' => now(),
        ];

        $timeoff = TimeOffSetting::create($validated);

        return redirect(route('timeoff-settings.index'))->with('success', 'Jenis cuti berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return TimeOffSetting::findOrFail($id);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $timeoff = TimeOffSetting::findOrFail($id);

        return view('dashboard.timeoff.edit', compact('timeoff'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(RequestStoreOrUpdateTimeOffSetting $request, $id)
    {
        $validated = $request->validated() + [
            'updated_at' => now(),
        ];

        $timeoff = TimeOffSetting::findOrFail($id);

        $timeoff->update($validated);

        return redirect(route('timeoff-settings.index'))->with('success', 'Jenis cuti berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $timeoff = TimeOffSetting::findOrFail($id);

        $timeoff->delete();

        return redirect(route('timeoff-settings.index'))->with('success', 'Jenis cuti berhasil dihapus.');
    }
}
