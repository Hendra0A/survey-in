<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class AccessController extends Controller
{
    public function index()
    {
        return view('login', [
            'tittle' => 'Login',
        ]);
    }
    public function authenticate(Request $request)
    {
        $isRemember = $request->remember;
        $credentials = $request->validate([
            'email' => 'required|email',
            'password' =>  'required'
        ]);

        if (Auth::attempt($credentials, $isRemember)) {
            if (Auth::user()->role == 'admin') {
                $request->session()->regenerate();
                if (!Auth::logoutOtherDevices($request->password)) {
                    $request->session()->flash('singleLogin', 'Silahkan login ulang / ganti password');
                }

                return redirect()->intended('/beranda');
            } elseif (Auth::user()->role == 'surveyor') {
                $request->session()->regenerate();
                if (!Auth::logoutOtherDevices($request->password)) {
                    $request->session()->flash('singleLogin', 'Silahkan login ulang / ganti password');
                }
                return redirect()->intended('/surveyor/beranda');
            }
        }
        return back()->with('loginError', 'Login failed!');
    }
    public function logout(Request $request)
    {

        Auth::logout();
        $request->session()->invalidate();
        $request->session()->regenerateToken();
        return redirect('/');
    }
}
