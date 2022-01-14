<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class IsPasswoodDefault
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/');
        } elseif (Hash::check('password', auth()->user()->getAuthPassword())) {
            if (auth()->user()->role == 'surveyor') {
                return redirect('/surveyor/pengaturan/edit-password')->with('info', 'Wajib Ganti Password Akun Surveyor saat login pertama kali');
            } elseif (auth()->user()->role == 'admin') {
                return redirect('/pengaturan/ubah-password');
            }
        }
        return $next($request);
    }
}
