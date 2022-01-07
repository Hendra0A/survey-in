<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Http\Request;
use App\Models\DetailSurveys;
use App\Http\Controllers\Controller;
use App\Models\Kecamatan;

class SurveyorController extends Controller
{
    public function index()
    {
        return view('user.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
            'surveyor' => auth()->user()->nama_lengkap,
            'area_survei' => Kabupaten::with('kecamatan')->where('id', auth()->user()->kabupaten_id)->get()[0],
            'data' => DetailSurveys::with('kecamatan')->where('user_id', auth()->user()->id)
                ->whereDate('tanggal_selesai', '>=', Carbon::now())
                ->get()[0]
        ]);
    }
    public function riwayatSurvei()
    {
        return view('user.riwayat-survei', [
            'title' => 'Riwayat Target',
            'active' => 'beranda',
            'data' => DetailSurveys::with('kecamatan')->where('user_id', auth()->user()->id)
                ->orderBy('id', 'ASC')
                ->get()
        ]);
    }
    public function dataSurvei()
    {
        return view('user.data-survei', [
            'title' => 'Riwayat Target',
            'active' => 'data-survei',
            'data' => Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)
                ->orderBy('id', 'ASC')->get(['id', 'nama'])
        ]);
    }
    public function myProfile()
    {
        return view('user.profile', [
            'title' => 'Riwayat Target',
            'active' => 'profile',
            'data' => auth()->user()
        ]);
    }
}
