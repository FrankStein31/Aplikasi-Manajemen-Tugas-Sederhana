<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        $totalUser      = User::count();
        $totalAdmin     = User::where('jabatan', 'admin')->count();
        $totalKaryawan  = User::where('jabatan', 'karyawan')->count();
        $belumDitugaskan = User::where('jabatan', 'karyawan')->where('status', 'belum_ditugaskan')->count();
        $ditugaskan     = User::where('jabatan', 'karyawan')->where('status', 'ditugaskan')->count();

        return view('admin.dashboard.index', compact(
            'totalUser',
            'totalAdmin',
            'totalKaryawan',
            'belumDitugaskan',
            'ditugaskan'
        ));
    }
}
