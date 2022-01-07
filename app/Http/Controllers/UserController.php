<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Kabupaten;

class UserController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
            'profile' => User::where('id', auth()->user()->id)->get(),
            'kabupaten' => Kabupaten::get(['id', 'nama']),
        ]);
    }
}
