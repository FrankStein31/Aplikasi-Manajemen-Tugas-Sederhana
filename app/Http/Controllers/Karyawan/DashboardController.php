<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\User;

class DashboardController extends Controller
{
    public function index()
    {
        $user = User::findOrFail(session('user_id'));
        return view('karyawan.dashboard.index', compact('user'));
    }
}
