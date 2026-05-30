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

    public function create()
    {
        return view('admin.user.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email',
            'jabatan'  => 'required|in:admin,karyawan',
            'password' => 'required|min:6|confirmed',
        ], [
            'name.required'     => 'Nama tidak boleh kosong.',
            'email.required'    => 'Email tidak boleh kosong.',
            'email.email'       => 'Format email tidak valid.',
            'email.unique'      => 'Email sudah terdaftar.',
            'jabatan.required'  => 'Jabatan harus dipilih.',
            'password.required' => 'Password tidak boleh kosong.',
            'password.min'      => 'Password minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'jabatan'  => $request->jabatan,
            'status'   => 'belum_ditugaskan', // Default status
            'password' => Hash::make($request->password),
        ]);

        return redirect()->route('admin.user.index')->with('success', 'Data user berhasil ditambahkan.');
    }

    public function edit(User $user)
    {
        return view('admin.user.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name'     => 'required|string|max:255',
            'email'    => 'required|email|unique:users,email,' . $user->id,
            'jabatan'  => 'required|in:admin,karyawan',
            'password' => 'nullable|min:6|confirmed',
        ], [
            'name.required'    => 'Nama tidak boleh kosong.',
            'email.required'   => 'Email tidak boleh kosong.',
            'email.email'      => 'Format email tidak valid.',
            'email.unique'     => 'Email sudah terdaftar.',
            'jabatan.required' => 'Jabatan harus dipilih.',
            'password.min'     => 'Password minimal 6 karakter.',
            'password.confirmed'=> 'Konfirmasi password tidak cocok.',
        ]);

        $data = [
            'name'    => $request->name,
            'email'   => $request->email,
            'jabatan' => $request->jabatan,
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
        $filename = 'DataUser-' . now()->format('d-m-Y H.i.s') . '.xlsx';
        return Excel::download(new UsersExport, $filename);
    }
}
