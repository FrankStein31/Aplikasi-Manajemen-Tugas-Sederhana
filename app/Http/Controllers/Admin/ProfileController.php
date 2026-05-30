<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    public function edit()
    {
        $user = User::findOrFail(session('user_id'));
        return view('admin.profile.edit', compact('user'));
    }

    public function update(Request $request)
    {
        $request->validate([
            'password_lama'         => 'required',
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password_lama.required'         => 'Password lama tidak boleh kosong.',
            'password.required'              => 'Password baru tidak boleh kosong.',
            'password.min'                   => 'Password baru minimal 6 karakter.',
            'password.confirmed'             => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong.',
        ]);

        $user = User::findOrFail(session('user_id'));

        // Cek password lama
        if (!Hash::check($request->password_lama, $user->password)) {
            return back()->withErrors(['password_lama' => 'Password Lama Tidak Sesuai'])->withInput();
        }

        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.profile.edit')
            ->with('success', 'Password berhasil diubah.');
    }
}
