<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use Illuminate\Http\Request;
use App\Models\DetailSurveys;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
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
            $validateData['avatar'] = $request->file('avatar')->store('avatar-images-surveyor');
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
            return redirect('/user/pengaturan')
                ->with('success', 'Password anda berhasil diubah');
        } else {
            return back()->withErrors(['kata_sandi_lama' => 'Kata sandi tidak cocok!']);
        }
    }
}
