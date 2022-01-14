<?php

namespace App\Http\Controllers;

use RealRashid\SweetAlert\Facades\Alert;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;
    public function __construct()
    {
        $this->middleware(function ($request, $next) {
            if (session('success')) {
                Alert::success('', session('success'))->showConfirmButton(session('confirm'), '#3085d6');;
            }

            if (session('error')) {
                Alert::error('', session('error'));
            }
            if (session('tsuccess')) {
                toast(session('tsuccess', 'success'))->autoClose(3000)->position('bottom-end');
            }
            if (session('terror')) {
                toast(session('tsuccess', 'error'))->autoClose(3000)->position('bottom-end');
            }
            if (session('info')) {
                Alert::info('', session('info'))->showConfirmButton('Ok', '#3085d6');
            }


            return $next($request);
        });
    }
}
