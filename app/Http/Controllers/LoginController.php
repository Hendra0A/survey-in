<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    //
    public function index()
    {
        return view('login', [
            'tittle' => 'Login',
        ]);
    }

    public Function authenticate(Request $request)
    {
        $credentials = $request->validate([
            //'email' => 'required|email:dns',
           'email' => 'required|email',
           'password' =>  'required'
        ]);

        if(Auth::attempt($credentials)) {
            if (Auth::user()->role == 'admin') { 
                $request->session()->regenerate();
                return redirect()->intended('/beranda');
                //return view('/beranda');
            } elseif (Auth::user()->role == 'surveyor') { 
                $request->session()->regenerate();
                return redirect()->intended('/beranda-user');
                //return view('murid.dahsboard');
            } 
            
            // dd($request);
           
        }

        return back()->with('loginError','Login failed!');
    }

    public function logout(Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('/');

    }

}
