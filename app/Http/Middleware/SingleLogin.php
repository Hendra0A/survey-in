<?php

namespace App\Http\Middleware;

use App\Models\User;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;

class SingleLogin
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

        $previous_session = auth()->user()->session_id;
        if ($previous_session !== Session::getId()) {
            $request->session()->invalidate();
            $request->session()->regenerate();
            User::find(auth()->user()->id)
                ->update([
                    'session_id' => Session::getId()
                ]);
        }
        return $next($request);
    }
}
