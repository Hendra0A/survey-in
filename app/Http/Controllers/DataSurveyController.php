<?php

namespace App\Http\Controllers;

use App\Models\Fasos;
use Barryvdh\DomPDF\PDF;
use App\Models\Kabupaten;
use App\Models\DataSurvey;
use App\Models\JenisFasos;
use Illuminate\Support\Arr;
use App\Models\LampiranFoto;
use Illuminate\Http\Request;
use App\Exports\DataSurveyExport;
use App\Models\DetailSurveys;
use Maatwebsite\Excel\Facades\Excel;

class DataSurveyController extends Controller
{
    public function index()
    {
        return view('admin.data-survei', [
            'active' => 'data survei',
            'title' => 'Data Survei',
            'kabupaten' => Kabupaten::get(['id', 'nama'])
        ]);
    }
    public function detail($id)
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('id', $id)->get();
        if (auth()->user()->role == 'admin') {

            return view('admin.data-survei.detail-data-survei', [
                'active' => 'data-survei',
                'title' => 'Data Survei',
                'data' => $data[0],
            ]);
        } elseif (auth()->user()->role == 'surveyor') {
            return view('user.detail-data-survei', [
                'active' => 'data-survei',
                'title' => 'Data Survei',
                'data' => $data[0],
            ]);
        }
    }
    public function destroy(Request $request)
    {
        try {
            DataSurvey::destroy($request->id);
            return redirect()->back()
                ->with('success', 'Berhasil Menghapus Data Survei')->with('confirm', 'ok');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Survei');
        }
    }
    public function printResume($id)
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan.kabupaten', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $id)->get();
        if (count($data) === 0) {
            return back()->with('error', 'Data Kosong!');;
        }
        return Excel::download(new DataSurveyExport($id), 'Resume Perumahan ' . $data[0]->kecamatan->nama . '.xlsx');
    }
    public function previewResume($id)
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $id)->get();
        $fasos = JenisFasos::all();
        // dd($data);
        return view('admin.data-survei.view-cetak-resume-detail-data-survei', [
            'title' => 'Data Survei',
            'datas' => $data,
            'fasos' => $fasos
        ]);
    }
    public function printPDF($id)
    {
        $data = DataSurvey::with(['kecamatan', 'konstruksiJalan', 'konstruksiSaluran', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('id', $id)->get();

        $pdf = app('dompdf.wrapper');

        //############ if image are not loading execute this code ################################
        $contxt = stream_context_create([
            'ssl' => [
                'verify_peer' => FALSE,
                'verify_peer_name' => FALSE,
                'allow_self_signed' => TRUE,
            ]
        ]);
        // jika erorr
        // jalankan di terminal
        // composer require barryvdh/laravel-dompdf
        // $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
        $pdf->getDomPDF()->setHttpContext($contxt);
        //#################################################################################

        //Cargar vista/tabla html y enviar varibles con la data
        $pdf->loadView('admin.data-survei.cetak-detail', [
            'title' => 'Data Survei',
            'data' => $data[0],
        ]);
        //descargar la vista en formato pdf 
        return $pdf->download($data[0]->nama_gang . ".pdf");
    }


    public function tambahData(Request $request)
    {
        $detail = DetailSurveys::find($request->id_detail);

        try {
            $request->validate([
                'kecamatan_id' => ['required'],
                'nama_gang' => ['required', 'max:255'],
                'lokasi' => ['required'],
                'no_gps' => ['required'],
                'jenis_konstruksi_jalan_id' => ['required'],
                'status_jalan' => ['required', 'numeric', 'min:0'],
                'dimensi_jalan_panjang' => ['required', 'numeric', 'min:0'],
                'dimensi_jalan_lebar' => ['required', 'numeric', 'min:0'],
                'dimensi_saluran_panjang_kanan' => ['nullable', 'numeric', 'min:0'],
                'dimensi_saluran_panjang_kiri' => ['nullable', 'numeric', 'min:0'],
                'dimensi_saluran_lebar_kanan' => ['nullable', 'numeric', 'min:0'],
                'dimensi_saluran_lebar_kiri' => ['nullable', 'numeric', 'min:0'],
                'dimensi_saluran_kedalaman_kanan' => ['nullable', 'numeric', 'min:0'],
                'dimensi_saluran_kedalaman_kiri' => ['nullable', 'numeric', 'min:0'],
                'status_saluran' => ['nullable', 'numeric', 'min:0'],
                'jumlah_rumah_layak' => ['nullable', 'numeric', 'min:0'],
                'jumlah_rumah_tak_layak' => ['nullable', 'numeric', 'min:0'],
                'jumlah_rumah_kosong' => ['nullable', 'numeric', 'min:0'],
                'jumlah_rumah_developer' => ['nullable', 'numeric', 'min:0'],
                'jumlah_rumah_swadaya' => ['nullable', 'numeric', 'min:0'],
                'jumlah_ruko_kiri' => ['nullable', 'numeric', 'min:0'],
                'lantai_ruko_kiri' => ['nullable', 'numeric', 'min:0'],
                'jumlah_ruko_kanan' => ['nullable', 'numeric', 'min:0'],
                'lantai_ruko_kanan' => ['nullable', 'numeric', 'min:0'],
            ]);
            $dataSurvey = DataSurvey::create([
                'user_id' => auth()->user()->id,
                'kecamatan_id' => $request->kecamatan_id,
                'nama_gang' => $request->nama_gang,
                'lokasi' => $request->lokasi,
                'no_gps' => $request->no_gps,
                'dimensi_jalan_panjang' => $request->dimensi_jalan_panjang === null ? 0 : $request->dimensi_jalan_panjang,
                'dimensi_jalan_lebar' => $request->dimensi_jalan_lebar === null ? 0 : $request->dimensi_jalan_lebar,
                'jenis_konstruksi_jalan_id' => $request->jenis_konstruksi_jalan_id,
                'status_jalan' => $request->status_jalan,
                'dimensi_saluran_panjang_kanan' => $request->dimensi_saluran_panjang_kanan,
                'dimensi_saluran_panjang_kiri' => $request->dimensi_saluran_panjang_kiri,
                'dimensi_saluran_lebar_kanan' => $request->dimensi_saluran_lebar_kanan,
                'dimensi_saluran_lebar_kiri' => $request->dimensi_saluran_lebar_kiri,
                'dimensi_saluran_kedalaman_kanan' => $request->dimensi_saluran_kedalaman_kanan,
                'dimensi_saluran_kedalaman_kiri' => $request->dimensi_saluran_kedalaman_kiri,
                'jenis_konstruksi_saluran_id' => $request->jenis_konstruksi_saluran_id,
                'status_saluran' => $request->status_saluran,
                'jumlah_rumah_layak' => $request->jumlah_rumah_layak === null ? 0 : $request->jumlah_rumah_layak,
                'jumlah_rumah_tak_layak' => $request->jumlah_rumah_tak_layak === null ? 0 : $request->jumlah_rumah_tak_layak,
                'jumlah_rumah_kosong' => $request->jumlah_rumah_kosong === null ? 0 : $request->jumlah_rumah_kosong,
                'jumlah_rumah_developer' => $request->jumlah_rumah_developer === null ? 0 : $request->jumlah_rumah_developer,
                'jumlah_rumah_swadaya' => $request->jumlah_rumah_swadaya === null ? 0 : $request->jumlah_rumah_swadaya,
                'jumlah_ruko_kiri' => $request->jumlah_ruko_kiri,
                'lantai_ruko_kiri' => $request->lantai_ruko_kiri,
                'jumlah_ruko_kanan' => $request->jumlah_ruko_kanan,
                'lantai_ruko_kanan' => $request->lantai_ruko_kanan,
                'pos_jaga' => $request->pos_jaga,
                'fasos' => $request->addmore[0]['jenis_fasos_id'] === null ? 0 : 1,
                'no_imb' => $request->no_imb,
                'catatan' => $request->catatan
            ]);
            $datasFasos = [];
            if ($request->addmore[0]['jenis_fasos_id'] !== null) {
                foreach ($request->addmore as $key => $value) {
                    if (!empty($request->addmore[0]['foto'])) {
                        $image = $value['foto'];
                        $md5Name = uniqid();
                        $guessExtension = $value['foto']->guessExtension();
                        $image->move(public_path('/storage/foto-fasos'), $md5Name . '.' . $guessExtension);
                        $fotoFasos = "foto-fasos/" . $md5Name . '.' . $guessExtension;
                        $data_fasos = Arr::add($value, 'data_survey_id', $dataSurvey->id);
                        $data_fasos['foto'] = $fotoFasos;
                        $datasFasos[] = $data_fasos;
                    }
                }
                foreach ($datasFasos as $dataFasos) {
                    Fasos::create($dataFasos);
                }
            }
            $datasLampiran = [];
            if ($request->addmoreLampiran[0]['jenis_lampiran_id'] !== null) {
                foreach ($request->addmoreLampiran as $key => $value) {
                    if (!empty($request->addmoreLampiran[0]['foto'])) {
                        $image = $value['foto'];
                        $md5Name = uniqid();
                        $guessExtension = $value['foto']->guessExtension();
                        $image->move(public_path('/storage/foto-lampiran'), $md5Name . '.' . $guessExtension);
                        $fotoLampiran = "foto-lampiran/" . $md5Name . '.' . $guessExtension;

                        // add element array
                        $data_lampiran = Arr::add($value, 'data_survey_id', $dataSurvey->id);

                        // change element array
                        $data_lampiran['foto'] = $fotoLampiran;
                        $datasLampiran[] = $data_lampiran;
                    }
                }
                foreach ($datasLampiran as $dataLampiran) {
                    LampiranFoto::create($dataLampiran);
                }
            }

            DetailSurveys::where('id', $request->id_detail)->update([
                'selesai' => $detail->selesai + 1
            ]);
            $request->session()->forget('jmlFasos');
            $request->session()->forget('jmlLampiran');

            return redirect('/surveyor/beranda')
                ->with('success', 'Data telah berhasil ditambahkan !')
                ->with('confirm', 'ok');
        } catch (\Throwable $th) {
            return redirect()->back()->withInput();
        }
    }
}
