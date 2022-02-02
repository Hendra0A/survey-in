<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Fasos;
use Barryvdh\DomPDF\PDF;
use App\Models\Kabupaten;
use App\Models\DataSurvey;
use App\Models\JenisFasos;
use Illuminate\Support\Arr;
use App\Models\LampiranFoto;
use Illuminate\Http\Request;
use App\Models\DetailSurveys;
use App\Exports\DataSurveyExport;
use Maatwebsite\Excel\Facades\Excel;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Storage;

class DataSurveyController extends Controller
{
    public function index()
    {
        return view('admin.data-survei', [
            'active' => 'data survei',
            'title' => 'Data Survey',
            'kabupaten' => Kabupaten::get(['id', 'nama'])
        ]);
    }
    public function detail($id)
    {

        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('id', $id)->get();
        if (auth()->user()->role == 'admin') {

            return view('admin.data-survei.detail-data-survei', [
                'active' => 'data-survei',
                'title' => 'Data Survey',
                'data' => $data[0],
            ]);
        } elseif (auth()->user()->role == 'surveyor') {
            return view('user.detail-data-survei', [
                'active' => 'data-survei',
                'title' => 'Data Survey',
                'data' => $data[0],
            ]);
        }
    }
    public function destroy(Request $request)
    {
        try {
            // data survey
            $created_at = DataSurvey::where('id', $request->id)->first()->created_at;
            $created_at_data_survey = Carbon::createFromFormat('Y-m-d H:i:s', $created_at)->format('Y-m-d');

            // detail data survey
            $detail_survey = DetailSurveys::get(['tanggal_mulai', 'tanggal_selesai', 'selesai']);

            $dat = [];
            foreach ($detail_survey as $detail) {
                $dates = [];
                $mulai = strtotime($detail->tanggal_mulai);
                $selesai = strtotime($detail->tanggal_selesai);

                while ($mulai <= $selesai) {
                    $dates[] = date('Y-m-d', $mulai);
                    $mulai = strtotime('+1 day', $mulai);
                }
                $dat[$detail->tanggal_mulai] = $dates;
                for ($i = 0; $i < count($dates); $i++) {
                    if ($dates[$i] === $created_at_data_survey) {
                        DataSurvey::destroy($request->id);
                        DetailSurveys::where('tanggal_mulai', $dat[$detail->tanggal_mulai])->update([
                            'selesai' => $detail->selesai - 1
                        ]);
                        return redirect()->back()
                            ->with('success', 'Berhasil Menghapus Data Survey')->with('confirm', 'ok');
                    }
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Survey');
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
            'title' => 'Data Survey',
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
            'title' => 'Data Survey',
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
                'no_gps_depan' => ['required'],
                'no_gps_belakang' => ['required'],
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
            if (!empty($request->addmoreLampiran)) {
                $request->validate([
                    'addmoreLampiran.*.jenis_lampiran_id' => ['required'],
                    'addmoreLampiran.*.foto' => ['required', 'image']
                ]);
            }
            if (!empty($request->addmore)) {
                $request->validate([
                    'addmore.*.jenis_fasos_id' => ['required'],
                    'addmore.*.koordinat_fasos' => ['required'],
                    'addmore.*.foto' => ['required', 'image'],
                    'addmore.*.panjang' => ['required', 'numeric'],
                    'addmore.*.lebar' => ['required', 'numeric']
                ]);
            }

            $dataSurvey = DataSurvey::create([
                'user_id' => auth()->user()->id,
                'kecamatan_id' => $request->kecamatan_id,
                'nama_gang' => $request->nama_gang,
                'lokasi' => $request->lokasi,
                'no_gps_depan' => $request->no_gps_depan,
                'no_gps_belakang' => $request->no_gps_belakang,
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
                'fasos' => empty($request->addmore) ? 0 : 1,
                'no_imb' => $request->no_imb,
                'catatan' => $request->catatan
            ]);

            // fasos
            $datasFasos = [];
            if (!empty($request->addmore)) {
                foreach ($request->addmore as $key => $value) {
                    if (!empty($request->addmore[0]['foto'])) {
                        $image = $value['foto'];
                        $name['imgname'] =  uniqid() . '.' . $image->guessExtension();
                        Image::make($image)->resize(200, 200)->save(public_path('/storage/foto-fasos/' . $name['imgname']));

                        $image_path = "foto-fasos/" . $name['imgname'];


                        // add element array
                        $data_fasos = Arr::add($value, 'data_survey_id', $dataSurvey->id);

                        // change element array
                        $data_fasos['foto'] = $image_path;
                        $datasFasos[] = $data_fasos;
                    }
                }
                foreach ($datasFasos as $dataFasos) {
                    Fasos::create($dataFasos);
                }
            }
            // lampiran
            $datasLampiran = [];
            if (!empty($request->addmoreLampiran)) {
                foreach ($request->addmoreLampiran as $key => $value) {
                    if (!empty($request->addmoreLampiran[0]['foto'])) {
                        // image
                        $image = $value['foto'];
                        $name['imgname'] = uniqid() . '.' . $image->guessExtension();
                        Image::make($image)->resize(200, 200)->save(public_path('/storage/foto-lampiran/') . $name['imgname']);
                        $image_path = "foto-lampiran/" . $name['imgname'];


                        // add element array
                        $data_lampiran = Arr::add($value, 'data_survey_id', $dataSurvey->id);

                        // change element array
                        $data_lampiran['foto'] = $image_path;
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
            return redirect()->back()->withInput()->with('error', 'Data Gagal Disimpan, input data belum lengkap');
        }
    }
    public function updateData(Request $request)
    {
        $request->validate([
            'kecamatan_id' => ['required'],
            'nama_gang' => ['required', 'max:255'],
            'lokasi' => ['required'],
            'no_gps_depan' => ['required'],
            'no_gps_belakang' => ['required'],
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

        if (!empty($request->addmore)) {
            $request->validate([
                'addmore.*.jenis_fasos_id' => ['required'],
                'addmore.*.koordinat_fasos' => ['required'],
                'addmore.*.foto' => ['image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'addmore.*.panjang' => ['required', 'numeric'],
                'addmore.*.lebar' => ['required', 'numeric']
            ]);
        }

        if (!empty($request->addmoreLampiran)) {
            $request->validate([
                'addmoreLampiran.*.jenis_lampiran_id' => ['required'],
                'addmoreLampiran.*.foto' => ['image', 'mimes:jpeg,png,jpg', 'max:2048']
            ]);
        }

        DataSurvey::where('id', $request->id)->update([
            'kecamatan_id' => $request->kecamatan_id,
            'nama_gang' => $request->nama_gang,
            'lokasi' => $request->lokasi,
            'no_gps_depan' => $request->no_gps_depan,
            'no_gps_belakang' => $request->no_gps_belakang,
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
            'fasos' => empty($request->addmore) ? 0 : 1,
            'no_imb' => $request->no_imb,
            'catatan' => $request->catatan
        ]);

        // fasos
        $count = count(Fasos::where('data_survey_id', $request->id)->get('id'));
        if (!empty($request->addmore[$count])) {
            $datasFasosNew = [];
            if ($request->addmore[$count]['jenis_fasos_id'] !== null) {
                foreach ($request->addmore as $key => $value) {
                    if ($value == $request->addmore[$count]) {
                        if (!empty($value['foto'])) {
                            // image
                            $image = $value['foto'];
                            $md5Name = uniqid();
                            $guessExtension = $value['foto']->guessExtension();
                            $image->move(public_path('/storage/foto-fasos'), $md5Name . '.' . $guessExtension);
                            $fotoFasos = "foto-fasos/" . $md5Name . '.' . $guessExtension;


                            $value['foto'] = $fotoFasos;
                        }
                        $value['data_survey_id'] = $request->id;
                        $datasFasosNew[] = $value;
                        $count++;
                    }
                }
                foreach ($datasFasosNew as $dataNew) {
                    Fasos::create($dataNew);
                }
            }
        }

        // lampiran
        $count = count(LampiranFoto::where('data_survey_id', $request->id)->get('id'));
        if (!empty($request->addmoreLampiran[$count])) {
            $datasLampiranNew = [];
            if ($request->addmoreLampiran[$count]['jenis_lampiran_id'] !== null) {
                foreach ($request->addmoreLampiran as $key => $value) {
                    if ($value == $request->addmoreLampiran[$count]) {
                        if (!empty($value['foto'])) {
                            // image



                            $image = $value['foto'];
                            $md5Name = uniqid();
                            $guessExtension = $value['foto']->guessExtension();
                            $image->move(public_path('/storage/foto-lampiran'), $md5Name . '.' . $guessExtension);
                            $fotoLampiran = "foto-lampiran/" . $md5Name . '.' . $guessExtension;

                            // add element array
                            $data_lampiran = Arr::add($image, 'data_survey_id', $request->id);

                            // change element array
                            $data_lampiran['foto'] = $fotoLampiran;
                            $datasLampiranNew[] = $data_lampiran;
                            $count++;
                        }
                    }
                }

                foreach ($datasLampiranNew as $dataNew) {
                    LampiranFoto::create($dataNew);
                }
            }
        }


        // fasos
        $datasFasos = [];
        $y = 0;
        if (!empty($request->addmore)) {
            foreach ($request->addmore as $key => $value) {
                if (!empty($value['foto'])) {
                    $image = $value['foto'];
                    $md5Name = uniqid();
                    $guessExtension = $value['foto']->guessExtension();
                    $image->move(public_path('/storage/foto-fasos'), $md5Name . '.' . $guessExtension);
                    $fotoFasos = "foto-fasos/" . $md5Name . '.' . $guessExtension;

                    // // add element array
                    $data_fasos = $value;

                    $data_fasos['foto'] = $fotoFasos;
                } else {
                    $fotoFasos = Fasos::where('data_survey_id', $request->id)->get('foto');
                    $data_fasos = Arr::add($value, 'foto', $fotoFasos[$y]->foto);
                }
                $datasFasos[] = $data_fasos;
                $y++;
            }

            $i = 0;
            foreach ($datasFasos as $dataFasos) {
                $id = Fasos::where('data_survey_id', $request->id)->get('id');
                Fasos::where('data_survey_id', $request->id)->where('id', $id[$i]->id)->update($dataFasos);
                $i++;
            }
        }

        // lampiran
        $datasLampiran = [];
        $z = 0;
        if (!empty($request->addmoreLampiran)) {
            foreach ($request->addmoreLampiran as $key => $value) {
                if (!empty($value['foto'])) {
                    // image
                    $image = $value['foto'];
                    $md5Name = uniqid();
                    $guessExtension = $value['foto']->guessExtension();
                    $image->move(public_path('/storage/foto-lampiran'), $md5Name . '.' . $guessExtension);
                    $fotoLampiran = "foto-lampiran/" . $md5Name . '.' . $guessExtension;

                    // add element array
                    $data_lampiran = $value;

                    $data_lampiran['foto'] = $fotoLampiran;
                } else {
                    $fotoLampiran = LampiranFoto::where('data_survey_id', $request->id)->get('foto');
                    $data_lampiran = Arr::add($value, 'foto', $fotoLampiran[$z]->foto);
                }
                $datasLampiran[] = $data_lampiran;
                $z++;
            }

            $j = 0;
            foreach ($datasLampiran as $dataLampiran) {
                $id = LampiranFoto::where('data_survey_id', $request->id)->get('id');
                LampiranFoto::where('data_survey_id', $request->id)->where('id', $id[$j]->id)->update($dataLampiran);
                $j++;
            }
        }

        return redirect('/surveyor/data-survei/detail/' . $request->id)
            ->with('success', 'Data telah berhasil diedit !')
            ->with('confirm', 'ok');
    }

    public function destroyEditData(Request $request)
    {
        if ($request->ajax()) {
            if ($request->idFasos) {
                Fasos::destroy($request->idFasos);
                return response()->json([
                    'success' => 'Record has been deleted successfully!',
                ]);
            }
            if ($request->idLampiran) {
                LampiranFoto::destroy($request->idLampiran);
                return response()->json([
                    'success' => 'Record has been deleted successfully!',
                ]);
            }
        }
    }
}
