<?php

namespace App\Http\Controllers\Karyawan;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;

class TugasController extends Controller
{
    public function index()
    {
        $user  = User::findOrFail(session('user_id'));
        $tugas = Tugas::where('user_id', $user->id)->get();
        return view('karyawan.tugas.index', compact('user', 'tugas'));
    }

    public function cetakPdf()
    {
        $user  = User::findOrFail(session('user_id'));
        $tugas = Tugas::where('user_id', $user->id)->get();
        $pdf   = Pdf::loadView('karyawan.tugas.cetak_pdf', compact('user', 'tugas'));
        return $pdf->download('tugas-' . $user->name . '.pdf');
    }
}
