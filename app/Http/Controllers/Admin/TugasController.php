<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tugas;
use App\Models\User;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\TugasExport;

class TugasController extends Controller
{
    public function index()
    {
        $tugas     = Tugas::with('user')->get();
        $karyawan  = User::where('jabatan', 'karyawan')->get();
        return view('admin.tugas.index', compact('tugas', 'karyawan'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'tugas'       => 'required|string',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        Tugas::create($request->only(['user_id', 'tugas', 'tgl_mulai', 'tgl_selesai']));

        // Update status karyawan menjadi ditugaskan
        User::where('id', $request->user_id)->update(['status' => 'ditugaskan']);

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil ditambahkan.');
    }

    public function show(Tugas $tugas)
    {
        $tugas->load('user');
        return response()->json($tugas);
    }

    public function update(Request $request, Tugas $tugas)
    {
        $request->validate([
            'user_id'     => 'required|exists:users,id',
            'tugas'       => 'required|string',
            'tgl_mulai'   => 'required|date',
            'tgl_selesai' => 'required|date|after_or_equal:tgl_mulai',
        ]);

        $oldUserId = $tugas->user_id;

        $tugas->update($request->only(['user_id', 'tugas', 'tgl_mulai', 'tgl_selesai']));

        // Update status karyawan baru menjadi ditugaskan
        User::where('id', $request->user_id)->update(['status' => 'ditugaskan']);

        // Jika karyawan lama tidak punya tugas lagi, set belum_ditugaskan
        if ($oldUserId != $request->user_id) {
            $sisaTugas = Tugas::where('user_id', $oldUserId)->count();
            if ($sisaTugas === 0) {
                User::where('id', $oldUserId)->update(['status' => 'belum_ditugaskan']);
            }
        }

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil diupdate.');
    }

    public function destroy(Tugas $tugas)
    {
        $userId = $tugas->user_id;
        $tugas->delete();

        // Jika karyawan tidak punya tugas lagi, set belum_ditugaskan
        $sisaTugas = Tugas::where('user_id', $userId)->count();
        if ($sisaTugas === 0) {
            User::where('id', $userId)->update(['status' => 'belum_ditugaskan']);
        }

        return redirect()->route('admin.tugas.index')->with('success', 'Tugas berhasil dihapus.');
    }

    public function exportPdf()
    {
        $tugas = Tugas::with('user')->get();
        $pdf = Pdf::loadView('admin.tugas.export_pdf', compact('tugas'));
        return $pdf->download('data-tugas.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new TugasExport, 'data-tugas.xlsx');
    }
}
