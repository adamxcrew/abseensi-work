<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class UserLogsController extends Controller
{
    public function index()
    {
        $userLogs = User::whereNotNull('user_log')->orderByDesc('id');

        $userLogs = $userLogs->paginate(50);

        return view('dashboard.user_logs.index', compact('userLogs'));
    }

    public function store()
    {
        $user = User::findOrFail(Auth::user()->id);

        $user->user_log = 'pending';

        $user->save();

        return redirect()->back()->with('success', 'Berhasil mengajukan permohonan');
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->user_log = 'approved';

        $user->save();

        return redirect()->back()->with('success', 'User log updated successfully.');
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);

        $user->user_log = 'rejected';

        $user->save();

        return redirect()->back()->with('success', 'User log deleted successfully.');
    }
}
