<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class IsKaryawan
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!session('user_id')) {
            return redirect()->route('login')->with('error', 'Silakan login terlebih dahulu.');
        }

        if (session('jabatan') !== 'karyawan') {
            if ($request->ajax()) {
                return response()->json(['message' => 'Anda tidak punya akses ke halaman ini.'], 403);
            }
            return redirect()->back()->with('error', 'Anda tidak punya akses ke halaman ini.');
        }

        return $next($request);
    }
}
