<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function showLogin()
    {
        if (session('user_id')) {
            if (session('jabatan') === 'admin') {
                return redirect()->route('admin.dashboard');
            }
            return redirect()->route('karyawan.dashboard');
        }
        return view('auth.login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required',
        ], [
            'email.required'    => 'Email Tidak Boleh Kosong',
            'email.email'       => 'Format Email Tidak Valid',
            'password.required' => 'Password Tidak Boleh Kosong',
        ]);

        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return back()->withErrors(['email' => 'Email atau Password salah.'])->withInput();
        }

        // Store session
        session([
            'user_id' => $user->id,
            'name'    => $user->name,
            'email'   => $user->email,
            'jabatan' => $user->jabatan,
        ]);

        if ($user->jabatan === 'admin') {
            return redirect()->route('admin.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
        }

        return redirect()->route('karyawan.dashboard')->with('success', 'Selamat datang, ' . $user->name . '!');
    }

    public function logout()
    {
        session()->flush();
        return redirect()->route('login')->with('success', 'Anda telah berhasil logout.');
    }
}
