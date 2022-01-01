<?php

namespace App\Http\Controllers;

use App\Models\Kecamatan;
use App\Models\Kabupaten;
use App\Models\DataSurvey;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ApiController extends Controller
{
    public function getData(Request $request)
    {
        $data = DataSurvey::with('kecamatan', 'user')->where('kecamatan_id', $request->id)->get();

        $response = [
            'data' => $data
        ];

        return response()->json($response, Response::HTTP_OK);
    }
    public function getKecamatan(Request $request)
    {

        $kecamatan = Kecamatan::where('kabupaten_id', $request->id)->get(['id', 'nama']);
        $response = [
            'message' => 'List of kecamatan',
            'data' => $kecamatan,
        ];
        return response()->json($response, Response::HTTP_OK);
    }
    public function dataSurveys(Request $request)
    {
        $dataSurvey = DataSurvey::with('kecamatan')->where('kecamatan_id', $request->id)->get();
        $panjangJalan = 0;
        $lebarJalan = 0;
        $jumlahRumah = 0;
        $jalanJelek = 0;
        $jalanBaik = 0;
        if ($dataSurvey->count() == 0) {
            $response = [];
            return response()->json($response, Response::HTTP_OK);
        };
        foreach ($dataSurvey as $data) {
            $panjangJalan = $panjangJalan + $data->dimensi_jalan_panjang;
            $lebarJalan = $panjangJalan + $data->dimensi_jalan_lebar;
            $jumlahRumah = $jumlahRumah + ($data->jumlah_rumah_layak + $data->jumlah_rumah_kosong + $data->jumlah_rumah_tak_layak);
            if ($data->status_jalan < 51) {
                $jalanJelek = $jalanJelek + $data->status_jalan;
            } else {
                $jalanBaik =  $jalanBaik + $data->status_jalan;
            }
        }
        $response = [
            'jumlah' => $dataSurvey->count(),
            'jumlahRumah' => $jumlahRumah,
            'panjangJalan' => $panjangJalan,
            'lebarJalan' => $lebarJalan,
            'jalanJelek' => round(($jalanJelek / ($jalanBaik + $jalanJelek)) * 100, 2),
            'jalanBaik' => round(($jalanBaik / ($jalanBaik + $jalanJelek)) * 100, 2)
        ];
        return response()->json($response, Response::HTTP_OK);
    }
}
