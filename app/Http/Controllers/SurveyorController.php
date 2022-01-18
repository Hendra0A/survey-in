<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Fasos;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\JenisFasos;
use Illuminate\Support\Arr;
use App\Models\LampiranFoto;
use Illuminate\Http\Request;
use App\Models\DetailSurveys;
use App\Models\JenisLampiran;
use App\Http\Controllers\Controller;
use App\Models\JenisKonstruksiJalan;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\JenisKonstruksiSaluran;

use function PHPUnit\Framework\isEmpty;
use Illuminate\Support\Facades\Storage;

class SurveyorController extends Controller
{
    public function index()
    {
        $data = DetailSurveys::with('kecamatan')->where('user_id', auth()->user()->id)
            ->whereDate('tanggal_selesai', '>=', Carbon::now())
            ->get();
        if (count($data) == 0) {
            $data = collect(
                [
                    'target' => '-',
                    'selesai' => '-',
                    'tanggal_selesai' => '',
                    'kecamatan_id' => 0,
                    'kecamatan' => collect(
                        [
                            'kecamatan_id' => 0,
                            'nama' => '-',
                        ]
                    )
                ]
            );
            $data = collect($data);
        } else {
            $data = $data[0];
        }
        return view('user.index', [
            'title' => 'Beranda',
            'active' => 'beranda',
            'area_survei' => Kabupaten::with('kecamatan')->where('id', auth()->user()->kabupaten_id)->get()[0],
            'data' => $data
        ]);
    }
    public function history()
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
    public function show()
    {
        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'data' => auth()->user()
        ];
        return view('user.profile', $data);
    }
    public function update()
    {
        $data = [
            'active' => 'Profile - Edit',
            'title' => 'Profile-Page',
            'data' => auth()->user()
        ];
        return view('user.edit-profile', $data);
    }

    public function updateProfile(Request $request)
    {
        // ddd($request);
        $validateData = $request->validate([
            'nama_lengkap' => ['required'],
            'tanggal_lahir' => ['required'],
            'gender' => ['required'],
            'alamat' => ['required'],
            'avatar' => 'image|file|max:2048'
        ]);

        if ($request->file('avatar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('avatar');
            $md5Name = md5_file($request->file('avatar')->getRealPath());
            $guessExtension = $request->file('avatar')->guessExtension();
            $image->move(public_path('/storage/avatar-images'), $md5Name . '.' . $guessExtension);
            $image_path = "avatar-images/" . $md5Name . '.' . $guessExtension;
            $validateData['avatar'] = $image_path;
        }
        try {
            User::where('id', $request->id)
                ->update($validateData);
            return redirect('/surveyor/profile')
                ->with('success', 'Profil admin telah berhasil di edit')
                ->with('confirm', 'Kembali ke Profil');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    public function pengaturan()
    {
        $data = [
            'active' => 'pengaturan',
            'title' => 'Pengaturan',
        ];
        return view('user.pengaturan', $data);
    }

    public function ubahPassword(Request $request)
    {
        return view('user.edit-password', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan - Ubah Password', [0],
        ]);
    }

    public function updatePassword(Request $request)
    {
        $request->validate([
            'kata_sandi_lama' => ['required', 'min:8'],
            'kata_sandi_baru' => ['required', 'min:8', 'confirmed'],
            'kata_sandi_baru_confirmation' => ['required', 'min:8']
        ]);

        // $user = User::where('id', auth()->user()->id)->get()[0];
        $currentPassword = auth()->user()->password;
        $kata_sandi_lama = request('kata_sandi_lama');

        if (Hash::check($kata_sandi_lama, $currentPassword)) {
            User::where('id', auth()->user()->id)->update([
                'password' => Hash::make($request->kata_sandi_baru)
            ]);
            return redirect('/surveyor/beranda')
                ->with('success', 'Password anda berhasil diubah')
                ->with('confirm', 'Kembali ke pengaturan');;
        } else {
            return back()->withErrors(['kata_sandi_lama' => 'Kata sandi tidak cocok!']);
        }
    }

    public function tentang()
    {
        return view('user.tentang', [
            'active' => 'tentang',
            'title' => 'Tentang'
        ]);
    }

    public function tambah()
    {

        $data = DetailSurveys::with('kecamatan')->where('user_id', auth()->user()->id)
            ->whereDate('tanggal_selesai', '>=', Carbon::now())
            ->get();
        if (count($data) == 0) {
            return redirect('/surveyor/beranda')->with('info', 'Anda belum memiliki target survey hari ini');
        } else {
            return view('user.tambah-data', [
                'active' => 'tambah data',
                'title' => 'Tambah Data Survei',
                'kecamatan' => $data[0]->kecamatan,
                'jalan' => JenisKonstruksiJalan::all(),
                'saluran' => JenisKonstruksiSaluran::all(),
                'fasos' => JenisFasos::all(),
                'lampiran' => JenisLampiran::all()
            ]);
        }
    }

    public function edit($id)
    {
        // dd(Fasos::where('data_survey_id', $id)->get());
        return view('user.edit-data', [
            'active' => 'tambah data',
            'title' => 'Tambah Data Survei',
            'kecamatans' => Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)
                ->orderBy('id', 'ASC')->get(['id', 'nama']),
            'jalan' => JenisKonstruksiJalan::all(),
            'saluran' => JenisKonstruksiSaluran::all(),
            'jenisFasos' => JenisFasos::all(),
            'fasos' => Fasos::where('data_survey_id', $id)->get(),
            'lampiran' => JenisLampiran::all(),
            'data' => DataSurvey::where('id', $id)->get()[0]
        ]);
    }

    public function updateData(Request $request)
    {
        DataSurvey::where('id', $request->id)->update([
            'nama_gang' => $request->nama_gang,
            'lokasi' => $request->lokasi,
            'kecamatan_id' => $request->kecamatan_id,
            'no_gps' => $request->no_gps,
            'jenis_konstruksi_jalan_id' => $request->jenis_konstruksi_jalan_id,
            'status_jalan' => $request->status_jalan,
            'dimensi_jalan_panjang' => $request->dimensi_jalan_panjang,
            'dimensi_jalan_lebar' => $request->dimensi_jalan_lebar,
            'dimensi_saluran_panjang_kanan' => $request->dimensi_saluran_panjang_kanan,
            'dimensi_saluran_panjang_kiri' => $request->dimensi_saluran_panjang_kiri,
            'dimensi_saluran_lebar_kanan' => $request->dimensi_saluran_lebar_kanan,
            'dimensi_saluran_lebar_kiri' => $request->dimensi_saluran_lebar_kiri,
            'dimensi_saluran_kedalaman_kanan' => $request->dimensi_saluran_kedalaman_kanan,
            'dimensi_saluran_kedalaman_kiri' => $request->dimensi_saluran_kedalaman_kiri,
            'status_saluran' => $request->status_saluran,
            'jenis_konstruksi_saluran_id' => $request->jenis_konstruksi_saluran_id,
            'jumlah_rumah_layak' => $request->jumlah_rumah_layak,
            'jumlah_rumah_tak_layak' => $request->jumlah_rumah_tak_layak,
            'jumlah_rumah_kosong' => $request->jumlah_rumah_kosong,
            'jumlah_rumah_developer' => $request->jumlah_rumah_developer,
            'jumlah_rumah_swadaya' => $request->jumlah_rumah_swadaya,
            'jumlah_ruko_kiri' => $request->jumlah_ruko_kiri,
            'lantai_ruko_kiri' => $request->lantai_ruko_kiri,
            'jumlah_ruko_kanan' => $request->jumlah_ruko_kanan,
            'lantai_ruko_kanan' => $request->lantai_ruko_kanan,
            'pos_jaga' => $request->pos_jaga,
            'no_imb' => $request->no_imb,
            'catatan' => $request->catatan
        ]);

        // fasos
        $datasFasos = [];
        $y = 0;
        if ($request->addmore[0]['jenis_fasos_id'] !== null) {
            foreach ($request->addmore as $key => $value) {
                if (!empty($request->addmore[0]['foto'])) {
                    // image

                    // upload store
                    $fotoFasos = $value['foto']->store('foto-fasos');

                    // // add element array
                    $data_fasos = $value;

                    $data_fasos['foto'] = $fotoFasos;

                    // // change element array
                    // $data_fasos['foto'] = $fotoFasos;
                } else {
                    $fotoFasos = Fasos::where('data_survey_id', $request->id)->get('foto');
                    $data_fasos = Arr::add($value, 'foto', $fotoFasos[$y]->foto);
                }
                $datasFasos[] = $data_fasos;
                $y++;
            }
            // dd($datasFasos);
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
        if ($request->addmoreLampiran[0]['jenis_lampiran_id'] !== null) {
            foreach ($request->addmoreLampiran as $key => $value) {
                if (!empty($request->addmoreLampiran[0]['foto'])) {
                    // image

                    // upload store
                    $fotoLampiran = $value['foto']->store('foto-lampiran');

                    // // add element array
                    $data_lampiran = $value;

                    $data_lampiran['foto'] = $fotoLampiran;

                    // // change element array
                    // $data_fasos['foto'] = $fotoFasos;
                } else {
                    $fotoLampiran = LampiranFoto::where('data_survey_id', $request->id)->get('foto');
                    $data_lampiran = Arr::add($value, 'foto', $fotoLampiran[$z]->foto);
                }
                $datasLampiran[] = $data_lampiran;
                $z++;
            }
            // dd($datasFasos);
            $j = 0;
            foreach ($datasLampiran as $dataLampiran) {
                $id = LampiranFoto::where('data_survey_id', $request->id)->get('id');
                LampiranFoto::where('data_survey_id', $request->id)->where('id', $id[$j]->id)->update($dataLampiran);
                $j++;
            }
        }

        return redirect('/')->with('success', 'Data telah berhasil di edit')->with('confirm', 'Kembali ke Beranda');
    }

    // public function edit($id)
    // {
    //     // dd(Fasos::where('data_survey_id', $id)->get());
    //     $data = [
    //         'active' => 'tambah data',
    //         'title' => 'Tambah Data Survei',
    //         'kecamatans' => Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)
    //             ->orderBy('id', 'ASC')->get(['id', 'nama']),
    //         'jalan' => JenisKonstruksiJalan::all(),
    //         'saluran' => JenisKonstruksiSaluran::all(),
    //         'jenisFasos' => JenisFasos::all(),
    //         'lampiran' => JenisLampiran::all(),
    //         'datasurvei' => DataSurvey::where('id', $id)->get()[0]
    //     ];

    //     return response()->json($data);
    // }
}
