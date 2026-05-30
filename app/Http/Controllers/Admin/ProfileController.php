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
            'password'              => 'required|min:6|confirmed',
            'password_confirmation' => 'required',
        ], [
            'password.required'              => 'Password baru tidak boleh kosong.',
            'password.min'                   => 'Password minimal 6 karakter.',
            'password.confirmed'             => 'Konfirmasi password tidak cocok.',
            'password_confirmation.required' => 'Konfirmasi password tidak boleh kosong.',
        ]);

        $user = User::findOrFail(session('user_id'));
        $user->update(['password' => Hash::make($request->password)]);

        return redirect()->route('admin.profile.edit')->with('success', 'Password berhasil diubah.');
    }
}
