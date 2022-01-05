<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\User;
use App\Models\Fasos;
use App\Models\Kabupaten;
use App\Models\Kecamatan;
use App\Models\DataSurvey;
use App\Models\JenisFasos;
use App\Models\LampiranFoto;
use Illuminate\Http\Request;
use App\Models\DetailSurveys;
use App\Models\JenisLampiran;
use App\Models\RiwayatSurvey;
use App\Http\Controllers\Controller;
use App\Models\JenisKonstruksiJalan;
use Illuminate\Support\Facades\Hash;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Models\JenisKonstruksiSaluran;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function beranda()
    {

        $data = [
            'title' => 'Beranda',
            'active' => 'beranda',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'gender', 'alamat', 'nomor_telepon', 'email', 'role', 'avatar'])[0],
            'kabupaten' => Kabupaten::get(['id', 'nama']),
        ];
        return view('admin.beranda', $data);
    }
    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'active' => 'profile',
            'profile' => User::where('role', 'admin')->get()[0]
        ];
        return view('admin.profile', $data);
    }
    public function profileEdit()
    {
        $data = [
            'active' => 'Profile - Edit',
            'title' => 'Profile-Page',
            'profile' => User::where('role', 'admin')->get()[0]
        ];
        return view('admin.edit-profile', $data);
    }
    public function profileUpdate(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required'],
            'nomor_telepon' => ['required'],
            'email' => ['required'],
            'nama_lengkap' => ['required'],
            'alamat' => ['required'],
            'tanggal_lahir' => ['required']
        ]);
        User::where('id', $request->id)
            ->update([
                'nama_lengkap' => $request->nama_lengkap,
                'gender' => $request->gender,
                'email' => $request->email,
                'tanggal_lahir' => $request->tanggal_lahir,
                'nomor_telepon' => $request->nomor_telepon,
                'alamat' => $request->alamat
            ]);
        return redirect('/profile')->withInput();
    }
    public function surveyor()
    {
        return view('admin.surveyor', [
            'active' => 'surveyor',
            'title' => 'Surveyor',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'surveyors' => User::where('role', 'surveyor')->get()
        ]);
    }
    public function surveyorProfile(Request $request)
    {
        $data = User::with(['detailSurvey.kecamatan', 'kabupaten'])->where('id', $request->id)->where('role', 'surveyor')->get();
        $selesai = 0;
        $target = 0;
        foreach ($data[0]->detailSurvey as $hasil) {
            $selesai = $selesai + $hasil->selesai;
            $target = $target + $hasil->target;
        }

        $detail = [
            'active' => 'surveyor',
            'title' => 'Surveyor - Profile',
            'profile' => $data[0],
            'selesai' => $selesai,
            'target' => $target,
            'detailSurvey' => $data[0]->detailSurvey,
            'area' => $data[0]->kabupaten
        ];
        return view('admin.surveyor.surveyor-profile', $detail);
    }
    public function addSurveyorTarget(Request $request)
    {
        $request->validate([
            'kecamatan' => ['required'],
            'tanggal_mulai' => ['required'],
            'target' => ['required'],
        ]);
        $tanggal_selesai =  Carbon::createFromFormat('Y-m-d', $request->tanggal_mulai);
        $tanggal_selesai = $tanggal_selesai->addDays(6);
        $simpan = [
            'user_id' => $request->id,
            'kecamatan_id' => $request->kecamatan,
            'tanggal_mulai' => $request->tanggal_mulai,
            'tanggal_selesai' => $tanggal_selesai,
            'target' => $request->target
        ];
        DetailSurveys::create($simpan);
        return redirect('/surveyor')->withInput();
    }
    public function editSurveyorTarget(Request $request)
    {
        $request->validate([
            'kecamatan' => ['required'],
            'tanggal_selesai' => ['required'],
            'target' => ['required'],
            'tanggal_selesai' => ['required']
        ]);
        DetailSurveys::where('id', $request->id)
            ->update([
                'kecamatan_id' => $request->kecamatan,
                'tanggal_mulai' => $request->tanggal_selesai,
                'tanggal_selesai' => $request->tanggal_selesai,
                'target' => $request->target,
            ]);
        return redirect('/surveyor')->withInput();
    }
    public function surveyorTarget(Request $request)
    {
        $user = User::with('kabupaten.kecamatan')->find($request->id);
        $detail = DetailSurveys::where('user_id', $request->id)
            ->whereDate('tanggal_selesai', '>=', Carbon::now())
            ->get();
        // dd($detail);
        if (count($detail) != 0) {
            $date1 = Carbon::now();
            $date2 = Carbon::createFromFormat('Y-m-d', $detail[0]->tanggal_selesai);
            $result = $date1->gt($date2);
        }

        $data = [
            'active' => 'surveyor',
            'title' => 'Surveyor - Tambah Target Surveyor',
            'profile' => User::where('role', 'admin')->get()[0],
            'profile_surveyor' => $user,
            'kecamatans' => $user->kabupaten->kecamatan
        ];
        if (count($detail) == 0) {
            // dd($data);
            return view('admin.surveyor.add-surveyor-target', $data);
        } else if ($date1->gte($date2)) {
            // dd($data);
            return view('admin.surveyor.add-surveyor-target', $data);
        } else {
            $surveyor = User::with(['detailSurvey' => function ($query) {
                $query->whereDate('tanggal_selesai', '>=', Carbon::now());
            }])->where('id', $request->id)->get();
            $data = [
                'active' => 'surveyor',
                'title' => 'Surveyor - Edit Target Surveyor',
                'profile' => User::where('role', 'admin')->get()[0],
                'profile_surveyor' => $surveyor[0],
                'detail_survey' => $surveyor[0]->detailSurvey[0],
                'kecamatans' => $user->kabupaten->kecamatan
            ];
            // dd($ta);
            return view('admin.surveyor.edit-surveyor-target', $data);
        }
    }

    public function tambahSurveyor(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'nomor_telepon' => ['required', 'numeric', 'unique:users'],
            'area' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users'],
        ]);

        User::create([
            "nama_lengkap" => $request->nama_lengkap,
            "nomor_telepon" => $request->nomor_telepon,
            "email" => $request->email,
            "kabupaten_id" => $request->area,
            "password" => Hash::make('surveyor')

        ]);

        return redirect('/surveyor')->withInput();
    }

    public function updateSurveyor(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required'],
            'nomor_telepon' => ['required'],
            'email' => ['required'],
            'area' => ['required']
        ]);
        User::where('id', $request->id)
            ->update([
                "nama_lengkap" => $request->nama_lengkap,
                "nomor_telepon" => $request->nomor_telepon,
                "email" => $request->email,
                'kabupaten_id' => $request->area,
                "password" => ($request == '') ? $request->oldPassword : Hash::make($request->password)
            ]);


        return redirect('/surveyor')->withInput();
    }
    public function getSurveyor($id)
    {
        $data = [
            'active' => 'Surveyor - Edit',
            'title' => 'Surveyor - Profile',
            'profile' => User::with('kabupaten')->where('id', $id)->get(['id', 'nama_lengkap', 'nomor_telepon', 'email', 'password', 'kabupaten_id'])[0],
            'kabupaten' => Kabupaten::all('id', 'nama')
        ];
        return view('admin.surveyor.edit', $data);
    }
    public function destroySuyveyor(Request $request)
    {
        User::destroy($request->id);
        return redirect('/surveyor')->with('success', 'Akun has been deleted!');
    }

    // Halaman Pengaturan Admin
    public function pengaturan()
    {
        return view('admin.pengaturan', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0]
        ]);
    }

    public function editDataSurvey()
    {
        return view('admin.pengaturan.edit-data-survey', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan-Edit Data',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'jalan' => JenisKonstruksiJalan::all(),
            'saluran' => JenisKonstruksiSaluran::all(),
            'sosial' => JenisFasos::all(),
            'lampiran' => JenisLampiran::all(),
        ]);
    }
    public function tambahJenisJalan(Request $request)
    {
        if ($request->jalan != '') {
            JenisKonstruksiJalan::create([
                "jenis" => $request->jalan,
            ]);
            return redirect('/pengaturan/edit-data-survey')->withInput();
        } else {
        }
    }
    public function createData($model, Request $data)
    {
        switch ($model) {
            case 'jalan':
                $data->validate([
                    'jalan' => ['required', 'unique:jenis_konstruksi_jalans,jenis', 'alpha']
                ]);

                JenisKonstruksiJalan::create([
                    "jenis" => $data->jalan,
                ]);
                break;
            case 'saluran':
                $data->validate([
                    'saluran' => ['required', 'unique:jenis_konstruksi_salurans,jenis', 'alpha']
                ]);

                JenisKonstruksiSaluran::create([
                    "jenis" => $data->saluran,
                ]);
                break;
            case 'fasos':
                $data->validate([
                    'fasos' => ['required', 'unique:jenis_fasos,jenis', 'alpha']
                ]);

                JenisFasos::create([
                    "jenis" => $data->fasos,
                ]);
                break;
            case 'lampiran':
                $data->validate([
                    'lampiran' => ['required', 'unique:jenis_lampirans,jenis', 'alpha']
                ]);

                // if ($data->lampiran == '') return redirect('/pengaturan/edit-data-survey');
                JenisLampiran::create([
                    "jenis" => $data->lampiran,
                ]);
                break;
            default:
                return redirect('/pengaturan/edit-data-survey');
        };

        return redirect('/pengaturan/edit-data-survey')->withInput();
    }
    public function editData(Request $request)
    {
        switch ($request->target) {
            case 'jalan':
                JenisKonstruksiJalan::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                break;
            case 'saluran':
                JenisKonstruksiSaluran::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                break;
            case 'fasos':
                JenisFasos::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                break;
            case 'lampiran':
                JenisLampiran::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                break;
            default:
                return redirect()->back();
        };

        return redirect()->back();
    }
    public function destroy(Request $request)
    {
        switch ($request->model) {
            case 'jalan':
                JenisKonstruksiJalan::destroy($request->id);
                break;
            case 'saluran':
                JenisKonstruksiSaluran::destroy($request->id);
                break;
            case 'fasos':
                JenisFasos::destroy($request->id);
                break;
            case 'lampiran':
                JenisLampiran::destroy($request->id);
                break;
            default:
                return redirect()->back();
        };

        return redirect('/pengaturan/edit-data-survey')->with('success', 'Data has been deleted!');
    }

    public function ubahPassword(Request $request)
    {
        return view('admin.pengaturan.ubah-password', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan - Ubah Password',
            'profile' => User::where('role', 'admin')->get()[0],
        ]);
    }
    public function updatePassword(Request $request)
    {
        $request->validate([
            'kata_sandi_lama' => ['required', 'min:8'],
            'kata_sandi_baru' => ['required', 'min:8', 'confirmed'],
            'kata_sandi_baru_confirmation' => ['required', 'min:8']
        ]);

        $admin = User::where('role', 'admin')->get()[0];

        $currentPassword = $admin->password;
        $kata_sandi_lama = request('kata_sandi_lama');

        if (Hash::check($kata_sandi_lama, $currentPassword)) {
            $admin->update([
                'password' => Hash::make($request->kata_sandi_baru)
            ]);
        } else {
            return back()->withErrors(['kata_sandi_lama' => 'Kata sandi tidak cocok!']);
        }


        return redirect('/pengaturan')->withInput();
    }
    public function dataSurvei()
    {
        return view('admin.data-survei', [
            'active' => 'data',
            'title' => 'Data Survei',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'kabupaten' => Kabupaten::get(['id', 'nama'])
        ]);
    }

    public function detailDataSurvei(Request $request)
    {
        $data = DataSurvey::with('jenisFasos')->where('id', $request->id)->get();
        if ($data[0]->fasos === 1) {
            $fasos = $data[0]->jenisFasos;
        } else {
            $fasos = 'Tidak ada';
        }

        return view('admin.data-survei.detail-data-survei', [
            'title' => 'Data Survei',
            'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'data' => $data[0],
            'fasos' => $fasos
        ]);
    }

    public function destroyDataSurvei($id)
    {
        DataSurvey::destroy($id);

        return redirect('/data-survei')->with('success', 'Data has been deleted!');
    }
}
