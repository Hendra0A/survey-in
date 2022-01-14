<?php

namespace App\Http\Controllers;

use Barryvdh\DomPDF\PDF;
use App\Models\Kabupaten;
use App\Models\DataSurvey;
use App\Models\JenisFasos;
use Illuminate\Http\Request;
use App\Exports\DataSurveyExport;
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
                ->with('success', 'Berhasil Menghapus Data Survei');
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
}
