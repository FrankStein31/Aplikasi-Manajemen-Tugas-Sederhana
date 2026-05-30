<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\UsersExport;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return view('admin.user.index', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'jabatan'  => 'required|in:admin,karyawan',
            'status'   => 'required|in:ditugaskan,belum_ditugaskan',
            'password' => 'required|min:6',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'jabatan'  => $request->jabatan,
            'status'   => $request->status,
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'    => 'required|string|max:255',
            'email'   => 'required|email|unique:users,email,' . $user->id,
            'jabatan' => 'required|in:admin,karyawan',
            'status'  => 'required|in:ditugaskan,belum_ditugaskan',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'jabatan' => $request->jabatan,
            'status'  => $request->status,
        ];

        if ($request->filled('password')) {
            $data['password'] = Hash::make($request->password);
        }

        $user->update($data);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil diupdate.');
    }

    public function destroy(User $user)
    {
        $user->delete();
        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil dihapus.');
    }

    public function exportPdf()
    {
        $users = User::all();
        $pdf = Pdf::loadView('admin.user.export_pdf', compact('users'));
        return $pdf->download('data-user.pdf');
    }

    public function exportExcel()
    {
        return Excel::download(new UsersExport, 'data-user.xlsx');
    }
}
