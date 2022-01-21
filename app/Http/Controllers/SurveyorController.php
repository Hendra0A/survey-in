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
            'title' => 'Profil',
            'active' => 'profile',
            'data' => auth()->user()
        ];
        return view('user.profile', $data);
    }
    public function update()
    {
        $data = [
            'active' => 'Profile - Edit',
            'title' => 'Profil',
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
                'title' => 'Tambah Data Survey',
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
        $data = DataSurvey::where('id', $id)->get()[0];
        if ($data->user_id != auth()->user()->id) {
            return redirect('/surveyor/data-survei')->with('info', 'Anda tidak memiliki akses untuk mengedit');
        } else {
            return view('user.edit-data', [
                'active' => 'tambah data',
                'title' => 'Tambah Data Survey',
                'kecamatans' => Kecamatan::where('kabupaten_id', auth()->user()->kabupaten_id)
                    ->orderBy('id', 'ASC')->get(['id', 'nama']),
                'jalan' => JenisKonstruksiJalan::all(),
                'saluran' => JenisKonstruksiSaluran::all(),
                'jenisFasos' => JenisFasos::all(),
                'fasos' => Fasos::where('data_survey_id', $id)->get(),
                'lampiran' => JenisLampiran::all(),
                'data' => $data
            ]);
        }
    }
}
