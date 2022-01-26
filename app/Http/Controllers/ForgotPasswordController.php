<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\ForgotPassword;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class ForgotPasswordController extends Controller
{
    public function showForgotPasswordForm()
    {
        return view('forgot-password');
    }

    public function submitForgotPasswordForm(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email']
        ]);

        $token = Str::random(32);
        $user = User::where('email', $request->email)->get()[0];
        // dd($user);
        $name = $user->nama_lengkap;

        ForgotPassword::create([
            'email' => $request->email,
            'token' => $token,
            'created_at' => Carbon::now()
        ]);

        Mail::send('forgot-password-email', ['token' => $token, 'name' => $name], function ($message) use ($request) {
            $message->subject('Reset Password');
            $message->from('hendrasurveyin@gmail.com', 'Admin Survey IdeKite');
            $message->to($request->email, User::where('email', $request->email)->get()[0]->nama_lengkap);
        });


        return redirect("/")->with('verifiedEmail', 'yes');
    }

    public function showResetPasswordForm($token)
    {
        $email = ForgotPassword::where('token', $token)->get()[0]->email;
        return view('reset-password', ['token' => $token, 'email' => $email]);
    }

    public function submitResetPasswordForm(Request $request)
    {
        $request->validate([
            'email' => ['required', 'email', 'exists:users,email'],
            'password' => ['required', 'min:8', 'confirmed'],
            'password_confirmation' => ['required']
        ]);

        $updatedPassword  = ForgotPassword::where(['email' => $request->email, 'token' => $request->token])->get();
        if (!$updatedPassword) {
            return back()->withInput()->with('message', 'Invalid token!');
        } else {
            User::where('email', $request->email)->update(['password' => Hash::make($request->password)]);
            ForgotPassword::where(['email' => $request->email])->delete();

            return redirect('/')->with('message', 'Your password has been changed!');
        }
    }
}
