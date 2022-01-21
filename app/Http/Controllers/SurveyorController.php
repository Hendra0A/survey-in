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
use Intervention\Image\Facades\Image;

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
        $validateData = $request->validate([
            'nama_lengkap' => ['required'],
            'tanggal_lahir' => ['required'],
            'gender' => ['required'],
            'alamat' => ['required'],
            'avatar' => 'image|file|'
        ]);

        if ($request->file('avatar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $image = $request->file('avatar');
            $name['imgname'] = auth()->user()->nama_lengkap.'_'.uniqid().'.'.$image->guessExtension();
            Image::make($image)->resize(115,115)->save(public_path('storage/avatar-images/').$name['imgname']);
            $image_path = "avatar-images/" .$name['imgname'];
            $validateData['avatar'] = $image_path;
        }
        try {
            User::where('id', $request->id)
                ->update($validateData);
            return redirect('/surveyor/profile')
                ->with('success', 'Profil surveyor telah berhasil di edit')->with('confirm', 'Ok');
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
                ->with('success', 'Password anda berhasil diubah')->with('confirm', 'Ok');
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
            ->get(['id', 'kecamatan_id']);
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
                'lampiran' => JenisLampiran::all(),
                'id_detail' => $data[0]->id
            ]);
        }
        
    }

    public function edit($id)
    {
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


        $count = count(Fasos::where('data_survey_id', $request->id)->get('id'));
        if (!empty($request->addmore[$count])) {
            $datasFasosNew = [];
            if ($request->addmore[$count]['jenis_fasos_id'] !== null) {
                $request->validate([
                    'addmore.*.jenis_fasos_id' => ['required'],
                    'addmore.*.koordinat_fasos' => ['required'],
                    'addmore.*.foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                    'addmore.*.panjang' => ['required', 'numeric'],
                    'addmore.*.lebar' => ['required', 'numeric']
                ]);
                foreach ($request->addmore as $key => $value) {
                    if ($value == $request->addmore[$count]) {
                        if (!empty($value['foto'])) {
                            // image
                            $image = $value['foto'];
                            $md5Name = md5_file($value['foto']->getRealPath());
                            $guessExtension = $value['foto']->guessExtension();
                            $image->move(public_path('/storage/foto-fasos'), $md5Name . '.' . $guessExtension);
                            $fotoFasos = "foto-fasos/" . $md5Name . '.' . $guessExtension;

                            // add element array
                            $data_fasos = Arr::add($value, 'data_survey_id', $request->id);

                            // change element array
                            $data_fasos['foto'] = $fotoFasos;
                            $datasFasosNew[] = $data_fasos;
                            $count++;
                        }
                    }
                }

                foreach ($datasFasosNew as $dataNew) {
                    Fasos::create($dataNew);
                }
            }
        }


        // fasos
        $datasFasos = [];
        $y = 0;
        if (!empty($request->addmore)) {
            $request->validate([
                'addmore.*.jenis_fasos_id' => ['required'],
                'addmore.*.koordinat_fasos' => ['required'],
                'addmore.*.foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048'],
                'addmore.*.panjang' => ['required', 'numeric'],
                'addmore.*.lebar' => ['required', 'numeric']
            ]);
            foreach ($request->addmore as $key => $value) {
                if (!empty($value['foto'])) {
                    $image = $value['foto'];
                    $md5Name = md5_file($value['foto']->getRealPath());
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
            $request->validate([
                'addmoreLampiran.*.jenis_lampiran_id' => ['required'],
                'addmoreLampiran.*.foto' => ['required', 'image', 'mimes:jpeg,png,jpg', 'max:2048']
            ]);
            foreach ($request->addmoreLampiran as $key => $value) {
                if (!empty($value['foto'])) {
                    // image
                    $image = $value['foto'];
                    $md5Name = md5_file($value['foto']->getRealPath());
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

        return redirect('/')->with('success', 'Data telah berhasil di edit')->with('confirm', 'Kembali ke Beranda');
    }

    public function destroyUpdateData($id)
    {
        LampiranFoto::destroy($id);
        return response()->json([
            'success' => 'Record has been deleted successfully!'
        ]);
    }
}
