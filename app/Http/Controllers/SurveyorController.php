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
            'email' => ['required'],
            'tanggal_lahir' => ['required'],
            'gender' => ['required'],
            'nomor_telepon' => ['required'],
            'alamat' => ['required'],
            'avatar' => 'image|file|max:2048'
        ]);

        if ($request->file('avatar')) {
            if ($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['avatar'] = $request->file('avatar')->store('avatar-images');
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
            Auth::logoutOtherDevices($request->kata_sandi_baru);
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

        return view('user.tambah-data', [
            'active' => 'tambah data',
            'title' => 'Tambah Data Survei',
            'data' => Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)
                ->orderBy('id', 'ASC')->get(['id', 'nama']),
            'jalan' => JenisKonstruksiJalan::all(),
            'saluran' => JenisKonstruksiSaluran::all(),
            'fasos' => JenisFasos::all(),
            'lampiran' => JenisLampiran::all()
        ]);
    }

    // public function tambahData(Request $request)
    // {
    //     $request->validate([
    //         'kecamatan_id' => ['required'],
    //         'nama_gang' => ['required', 'max:255'],
    //         'lokasi' => ['required'],
    //         'no_gps' => ['required'],
    //         'jenis_konstruksi_jalan_id' => ['required'],
    //         'status_jalan' => ['required', 'numeric', 'min:0'],
    //         'dimensi_jalan_panjang' => ['required', 'numeric', 'min:0'],
    //         'dimensi_jalan_lebar' => ['required', 'numeric', 'min:0'],
    //         'dimensi_saluran_panjang_kanan' => ['nullable', 'numeric', 'min:0'],
    //         'dimensi_saluran_panjang_kiri' => ['nullable', 'numeric', 'min:0'],
    //         'dimensi_saluran_lebar_kanan' => ['nullable', 'numeric', 'min:0'],
    //         'dimensi_saluran_lebar_kiri' => ['nullable', 'numeric', 'min:0'],
    //         'dimensi_saluran_kedalaman_kanan' => ['nullable', 'numeric', 'min:0'],
    //         'dimensi_saluran_kedalaman_kiri' => ['nullable', 'numeric', 'min:0'],
    //         'status_saluran' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_rumah_layak' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_rumah_tak_layak' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_rumah_kosong' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_rumah_developer' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_rumah_swadaya' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_ruko_kiri' => ['nullable', 'numeric', 'min:0'],
    //         'lantai_ruko_kiri' => ['nullable', 'numeric', 'min:0'],
    //         'jumlah_ruko_kanan' => ['nullable', 'numeric', 'min:0'],
    //         'lantai_ruko_kanan' => ['nullable', 'numeric', 'min:0'],
    //     ]);

    //     try {
    //         $dataSurvey = DataSurvey::create([
    //             'user_id' => auth()->user()->id,
    //             'kecamatan_id' => $request->kecamatan_id,
    //             'nama_gang' => $request->nama_gang,
    //             'lokasi' => $request->lokasi,
    //             'no_gps' => $request->no_gps,
    //             'dimensi_jalan_panjang' => $request->dimensi_jalan_panjang === null ? 0 : $request->dimensi_jalan_panjang,
    //             'dimensi_jalan_lebar' => $request->dimensi_jalan_lebar === null ? 0 : $request->dimensi_jalan_lebar,
    //             'jenis_konstruksi_jalan_id' => $request->jenis_konstruksi_jalan_id,
    //             'status_jalan' => $request->status_jalan,
    //             'dimensi_saluran_panjang_kanan' => $request->dimensi_saluran_panjang_kanan,
    //             'dimensi_saluran_panjang_kiri' => $request->dimensi_saluran_panjang_kiri,
    //             'dimensi_saluran_lebar_kanan' => $request->dimensi_saluran_lebar_kanan,
    //             'dimensi_saluran_lebar_kiri' => $request->dimensi_saluran_lebar_kiri,
    //             'dimensi_saluran_kedalaman_kanan' => $request->dimensi_saluran_kedalaman_kanan,
    //             'dimensi_saluran_kedalaman_kiri' => $request->dimensi_saluran_kedalaman_kiri,
    //             'jenis_konstruksi_saluran_id' => $request->jenis_konstruksi_saluran_id,
    //             'status_saluran' => $request->status_saluran,
    //             'jumlah_rumah_layak' => $request->jumlah_rumah_layak === null ? 0 : $request->jumlah_rumah_layak,
    //             'jumlah_rumah_tak_layak' => $request->jumlah_rumah_tak_layak === null ? 0 : $request->jumlah_rumah_tak_layak,
    //             'jumlah_rumah_kosong' => $request->jumlah_rumah_kosong === null ? 0 : $request->jumlah_rumah_kosong,
    //             'jumlah_rumah_developer' => $request->jumlah_rumah_developer === null ? 0 : $request->jumlah_rumah_developer,
    //             'jumlah_rumah_swadaya' => $request->jumlah_rumah_swadaya === null ? 0 : $request->jumlah_rumah_swadaya,
    //             'jumlah_ruko_kiri' => $request->jumlah_ruko_kiri,
    //             'lantai_ruko_kiri' => $request->lantai_ruko_kiri,
    //             'jumlah_ruko_kanan' => $request->jumlah_ruko_kanan,
    //             'lantai_ruko_kanan' => $request->lantai_ruko_kanan,
    //             'pos_jaga' => $request->pos_jaga,
    //             'fasos' => $request->addmore[0]['jenis_fasos_id'] === null ? 0 : 1,
    //             'no_imb' => $request->no_imb,
    //             'catatan' => $request->catatan
    //         ]);

    //         // if ($jenis_fasos_id !== null || $jenis_lampiran_id !== null) {
    //         //     $request->validate([
    //         //         'koordinat_fasos' => ['required'],
    //         //         'foto' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
    //         //     ]);
    //         // }


    //         // fasos
    //         $datasFasos = [];
    //         if ($request->addmore[0]['jenis_fasos_id'] !== null) {
    //             // $request->validate([
    //             //     "addmore[0]['jenis_fasos_id']" => ['required'],
    //             //     "addmore[0]['koordinat_fasos']" => ['required'],
    //             //     "addmore[0]['foto']" => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
    //             // ]);
    //             // dd($request->addmore);
    //             foreach ($request->addmore as $key => $value) {
    //                 if (!empty($request->addmore[0]['foto'])) {
    //                     // image
    //                     $fotoFasos_nameWithExt = $value['foto']->getClientOriginalName();

    //                     // get filename
    //                     $fotoFasos_name = pathinfo($fotoFasos_nameWithExt, PATHINFO_FILENAME);

    //                     // encrypt
    //                     $fotoFasos_encrypt_name = encrypt($fotoFasos_name);

    //                     // get just extension
    //                     $fotoFasos_extension = $value['foto']->getClientOriginalExtension();

    //                     // filename to store
    //                     $fotoFasosStore = $fotoFasos_encrypt_name . '_' . time() . '.' . $fotoFasos_extension;

    //                     // upload store
    //                     $fotoFasos = $value['foto']->storeAs('foto-fasos', $fotoFasosStore);

    //                     // add element array
    //                     $data_fasos = Arr::add($value, 'data_survey_id', $dataSurvey->id);

    //                     // change element array
    //                     $data_fasos['foto'] = $fotoFasos;
    //                     $datasFasos[] = $data_fasos;
    //                 }
    //             }

    //             foreach ($datasFasos as $dataFasos) {
    //                 Fasos::create($dataFasos);
    //             }
    //         }

    //         // lampiran
    //         $datasLampiran = [];
    //         if ($request->addmoreLampiran[0]['jenis_lampiran_id'] !== null) {
    //             // $request->validate([
    //             //     'jenis_lampiran_id' => ['required'],
    //             //     'foto' => ['required', 'image', 'mimes:jpg,png,jpeg', 'max:2048'],
    //             // ]);
    //             // dd($request->addmoreLampiran);
    //             foreach ($request->addmoreLampiran as $key => $value) {

    //                 if (!empty($request->addmoreLampiran[0]['foto'])) {
    //                     // image
    //                     $fotoLampiran_nameWithExt = $value['foto']->getClientOriginalName();

    //                     // get filename
    //                     $fotoLampiran_name = pathinfo($fotoLampiran_nameWithExt, PATHINFO_FILENAME);

    //                     // encrypt
    //                     $fotoLampiran_encrypt_name = encrypt($fotoLampiran_name);

    //                     // get just extension
    //                     $fotoLampiran_extension = $value['foto']->getClientOriginalExtension();

    //                     // filename to store
    //                     $fotoLampiranStore = $fotoLampiran_encrypt_name . '_' . time() . '.' . $fotoLampiran_extension;

    //                     // upload store
    //                     $fotoLampiran = $value['foto']->storeAs('foto-lampiran', $fotoLampiranStore);

    //                     // add element array
    //                     $data_lampiran = Arr::add($value, 'data_survey_id', $dataSurvey->id);

    //                     // change element array
    //                     $data_lampiran['foto'] = $fotoLampiran;
    //                     $datasLampiran[] = $data_lampiran;
    //                 }
    //             }

    //             foreach ($datasLampiran as $dataLampiran) {
    //                 LampiranFoto::create($dataLampiran);
    //             }
    //         }

    //         return redirect('/surveyor')
    //             ->with('success', 'Data telah berhasil ditambahkan !')
    //             ->with('confirm', 'Kembali ke Surveyor');
    //     } catch (\Exception $e) {
    //         return redirect()->back()->withInput();
    //     }
    // }
}
