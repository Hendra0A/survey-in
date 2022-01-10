<?php

namespace App\Http\Controllers;

use PDF;
use Carbon\Carbon;
use Dompdf\Dompdf;
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
use App\Exports\DataSurveyExport;
use App\Http\Controllers\Controller;
use App\Models\JenisKonstruksiJalan;
use Illuminate\Support\Facades\Hash;
use Maatwebsite\Excel\Facades\Excel;
use PhpParser\Node\Expr\AssignOp\Mod;
use App\Models\JenisKonstruksiSaluran;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;

// jika erorr menggunakan alert
// jalankan composer install
class AdminController extends Controller
{
    public function beranda()
    {

        $data = [
            'title' => 'Beranda',
            'active' => 'beranda',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'gender', 'alamat', 'nomor_telepon', 'email', 'role', 'avatar']),
            'kabupaten' => Kabupaten::get(['id', 'nama']),
        ];
        return view('admin.beranda', $data);
    }
    public function profile()
    {
        $data = [
            'title' => 'Profile',
            'active' => 'profile',
        ];
        return view('admin.profile', $data);
    }
    public function profileEdit()
    {
        $data = [
            'active' => 'Profile - Edit',
            'title' => 'Profile-Page',
            'data' => auth()->user()
        ];
        return view('admin.edit-profile', $data);
    }
    public function profileUpdate(Request $request)
    {
        // ddd($request);
        $validateData = $request->validate([
            'nama_lengkap' => ['required'],
            'nomor_telepon' => ['required'],
            'email' => ['required'],
            'nama_lengkap' => ['required'],
            'alamat' => ['required'],
            'tanggal_lahir' => ['required'],
            'avatar' => 'image|file|max:2048'
        ]);

        if($request->file('avatar')) {
            if($request->oldImage) {
                Storage::delete($request->oldImage);
            }
            $validateData['avatar'] = $request->file('avatar')->store('avatar-images');
        }

        try {
            User::where('id', $request->id)
                ->update([
                    'nama_lengkap' => $request->nama_lengkap,
                    'gender' => $request->gender,
                    'email' => $request->email,
                    'tanggal_lahir' => $request->tanggal_lahir,
                    'nomor_telepon' => $request->nomor_telepon,
                    'alamat' => $request->alamat,
                    'avatar' => $validateData['avatar'],
                ]);
            return redirect('/profile')
                ->with('success', 'Berhasil Mengubah Profile');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }
    public function surveyor()
    {
        return view('admin.surveyor', [
            'active' => 'surveyor',
            'title' => 'Surveyor',
            'surveyors' => User::where('role', 'surveyor')->get()
        ]);
    }

    public function surveyortambah()
    {
        return view('admin.surveyor.tambah', [
            'active' => 'surveyor',
            'title' => 'Surveyor - Tambah Surveyor',
            'kabupaten' => Kabupaten::all('id', 'nama')
        ]);
    }
    public function tambahSurveyor(Request $request)
    {
        $request->validate([
            'nama_lengkap' => ['required', 'max:255'],
            'nomor_telepon' => ['required', 'numeric', 'unique:users'],
            'area' => ['required'],
            'email' => ['required', 'email:dns', 'unique:users'],
        ]);

        try {
            User::create([
                "nama_lengkap" => $request->nama_lengkap,
                "nomor_telepon" => $request->nomor_telepon,
                "email" => $request->email,
                "kabupaten_id" => $request->area,
                "password" => Hash::make('surveyor')

            ]);
            return redirect('/surveyor')
                ->with('success', 'Akun Surveyor berhasil dibuat !');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }

    public function surveyorProfile(Request $request)
    {
        $data = User::with(['detailSurvey.kecamatan', 'kabupaten'])->where('id', $request->id)->where('role', 'surveyor')->get();
        $selesai = 0;
        $target = 0;
        $weekly_target = 0;
        $weekly_selesai = 0;
        foreach ($data[0]->detailSurvey as $hasil) {
            $selesai = $selesai + $hasil->selesai;
            $target = $target + $hasil->target;
            $date1 = Carbon::now();
            $date2 = Carbon::createFromFormat('Y-m-d', $hasil->tanggal_selesai);
            if ($date1->gt($date2)) {
                $weekly_target = $hasil->target;
                $weekly_selesai = $hasil->selesai;
            }
        }

        $detail = [
            'active' => 'surveyor',
            'title' => 'Surveyor - Profile', [0],
            'profile_surveyor' => $data[0],
            'selesai' => $selesai,
            'target' => $target,
            'weekly_target' => $weekly_target,
            'weekly_selesai' => $weekly_selesai,
            'detailSurvey' => $data[0]->detailSurvey,
            'area' => $data[0]->kabupaten
        ];
        // dd($detail);
        return view('admin.surveyor.surveyor-profile', $detail);
    }
    public function addSurveyorTarget(Request $request)
    {
        $request->validate([
            'kecamatan' => ['required'],
            'tanggal_mulai' => ['required'],
            'target' => ['required'],
            'kategori' => ['required'],
        ]);
        $tanggal_selesai =  Carbon::createFromFormat('Y-m-d', $request->tanggal_mulai);
        $tanggal_selesai = $tanggal_selesai->addDays($request->kategori - 1);
        try {
            DetailSurveys::create([
                'user_id' => $request->id,
                'kecamatan_id' => $request->kecamatan,
                'tanggal_mulai' => $request->tanggal_mulai,
                'tanggal_selesai' => $tanggal_selesai,
                'target' => $request->target
            ]);
            return redirect('/surveyor')
                ->with('success', 'Berhasil Menambahkan Target Surveyor');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }
    public function editSurveyorTarget(Request $request)
    {
        $request->validate([
            'kecamatan' => ['required'],
            'tanggal_selesai' => ['required'],
            'target' => ['required'],
            'tanggal_selesai' => ['required']
        ]);
        try {
            DetailSurveys::where('id', $request->id)
                ->update([
                    'kecamatan_id' => $request->kecamatan,
                    'tanggal_mulai' => $request->tanggal_mulai,
                    'tanggal_selesai' => $request->tanggal_selesai,
                    'target' => $request->target,
                ]);
            return redirect('/surveyor')
                ->with('success', 'Berhasil Mengubah Target Surveyor');
        } catch (\Exception $e) {
            return redirect()->back()->withInput();
        }
    }
    public function surveyorTarget(Request $request)
    {
        $user = User::with('kabupaten.kecamatan')->find($request->id);
        $detail = DetailSurveys::where('user_id', $request->id)
            ->whereDate('tanggal_selesai', '>=', Carbon::now())
            ->get();
        if (count($detail) != 0) {
            $date1 = Carbon::now();
            $date2 = Carbon::createFromFormat('Y-m-d', $detail[0]->tanggal_selesai);
            $result = $date1->gt($date2);
        }

        $data = [
            'active' => 'surveyor',
            'title' => 'Surveyor - Tambah Target Surveyor', [0],
            'profile_surveyor' => $user,
            'kecamatans' => $user->kabupaten->kecamatan
        ];
        if (count($detail) == 0) {
            return view('admin.surveyor.add-surveyor-target', $data);
        } else if ($date1->gte($date2)) {
            return view('admin.surveyor.add-surveyor-target', $data);
        } else {
            $surveyor = User::with(['detailSurvey' => function ($query) {
                $query->whereDate('tanggal_selesai', '>=', Carbon::now());
            }])->where('id', $request->id)->get();
            $data = [
                'active' => 'surveyor',
                'title' => 'Surveyor - Edit Target Surveyor',
                [0],
                'profile_surveyor' => $surveyor[0],
                'detail_survey' => $surveyor[0]->detailSurvey[0],
                'kecamatans' => $user->kabupaten->kecamatan
            ];
            return view('admin.surveyor.edit-surveyor-target', $data);
        }
    }
    public function updateSurveyor(Request $request)
    {
        if ($request->target == '1') {
            $request->validate([
                'nama_lengkap' => ['required'],
                'area' => ['required'],
                'nomor_telepon' => ['required'],
                'email' => ['required'],
            ]);
            try {
                User::where('id', $request->id)
                    ->update([
                        'nama_lengkap' => $request->nama_lengkap,
                        'kabupaten_id' => $request->area,
                        'nomor_telepon' => $request->nomor_telepon,
                        'email' => $request->email,
                    ]);
                return redirect('/surveyor')
                    ->with('success', 'Berhasil Update Profile Surveyor');
            } catch (\Exception $e) {
                return redirect()->back()->withInput();
            }
        } elseif ($request->target == '2') {
            $request->validate([
                'password' => ['required', 'confirmed'],
                'password_confirmation' => ['required'],
            ]);
            try {
                User::where('id', $request->id)
                    ->update([
                        'password' => Hash::make($request->password)
                    ]);
                return redirect('/surveyor')
                    ->with('success', 'Berhasil Mengubah Password');
            } catch (\Exception $e) {
                return redirect()->back()->withInput();
            }

            return redirect('/surveyor')->withInput();
        }
    }
    public function getSurveyor(Request $request)
    {
        if ($request->target == '1') {
            $data = [
                'active' => 'surveyor',
                'title' => 'Surveyor - Edit Profile Surveyor',
                'kabupaten' => Kabupaten::all(),
                'profile' => User::where('id', $request->id)
                    ->where('role', 'surveyor')
                    ->get()[0]
            ];
            return view('admin.surveyor.edit-profile', $data);
        } elseif ($request->target == '2') {
            $data = [
                'active' => 'surveyor',
                'title' => 'Surveyor - Edit Password',
                'profile' => User::where('id', $request->id)
                    ->where('role', 'surveyor')
                    ->get(['avatar', 'nama_lengkap', 'role', 'id'])[0]
            ];
            return view('admin.surveyor.edit-password', $data);
        }
    }
    public function destroySuyveyor(Request $request)
    {
        try {
            User::destroy($request->id);
            return redirect()->back()
                ->with('success', 'Berhasil Menghapus');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Mengapus Akun Surveyor');
        }
    }

    // Halaman Pengaturan Admin
    public function pengaturan()
    {
        return view('admin.pengaturan', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0]
        ]);
    }

    public function editDataSurvey()
    {
        return view('admin.pengaturan.edit-data-survey', [
            'active' => 'pengaturan',
            'title' => 'Pengaturan-Edit Data',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
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
                    'jalan' => ['required', 'unique:jenis_konstruksi_jalans,jenis']
                ]);
                JenisKonstruksiJalan::create([
                    "jenis" => $data->jalan,
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil menambah jenis kontruksi jalan');
                break;
            case 'saluran':
                $data->validate([
                    'saluran' => ['required', 'unique:jenis_konstruksi_salurans,jenis']
                ]);

                JenisKonstruksiSaluran::create([
                    "jenis" => $data->saluran,
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil menambah jenis kontruksi saluran');
                break;
            case 'fasos':
                $data->validate([
                    'fasos' => ['required', 'unique:jenis_fasos,jenis']
                ]);

                JenisFasos::create([
                    "jenis" => $data->fasos,
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil menambah jenis fasilitas sosial');
                break;
            case 'lampiran':
                $data->validate([
                    'lampiran' => ['required', 'unique:jenis_lampirans,jenis']
                ]);
                JenisLampiran::create([
                    "jenis" => $data->lampiran,
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil menambah jenis lampiran');
                break;
            default:
                return redirect('/pengaturan/edit-data-survey');
        };

        return redirect('/pengaturan/edit-data-survey')->withInput();
    }
    public function editData(Request $request)
    {
        switch ($request->model) {
            case 'jalan':
                JenisKonstruksiJalan::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil diubah');
                break;
            case 'saluran':
                JenisKonstruksiSaluran::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil diubah');
                break;
            case 'fasos':
                JenisFasos::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil diubah');
                break;
            case 'lampiran':
                JenisLampiran::where('id', $request->id)->update([
                    'jenis' => $request->jenis
                ]);
                return redirect()->back()
                    ->with('success', 'Berhasil diubah');
                break;
            default:
                return redirect()->back()->with('error', 'Gagal Mengubah');
        };
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


        $admin = User::where('role', 'admin')->where('id', auth()->user()->id)->get()[0];
        // dd($admin);

        $currentPassword = $admin->password;
        $kata_sandi_lama = request('kata_sandi_lama');

        if (Hash::check($kata_sandi_lama, $currentPassword)) {
            $admin->update([
                'password' => Hash::make($request->kata_sandi_baru)
            ]);
            return redirect('/pengaturan')
                ->with('success', 'Password anda berhasil diubah');
        } else {
            return back()->withErrors(['kata_sandi_lama' => 'Kata sandi tidak cocok!']);
        }
    }
    public function dataSurvei()
    {
        return view('admin.data-survei', [
            'active' => 'data survei',
            'title' => 'Data Survei',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'kabupaten' => Kabupaten::get(['id', 'nama'])
        ]);
    }

    public function detailDataSurvei($id)
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('id', $id)->get();
        return view('admin.data-survei.detail-data-survei', [
            'title' => 'Data Survei',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'data' => $data[0],
        ]);
    }

    public function viewCetakResumeDataSurvei($id)
    {
        $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasosTable.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $id)->get();
        $fasos = JenisFasos::all();
        // dd($data);
        return view('admin.data-survei.view-cetak-resume-detail-data-survei', [
            'title' => 'Data Survei',
            // 'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
            'datas' => $data,
            'fasos' => $fasos
        ]);
    }

    public function cetakResumeDataSurvei($id)
    {
        return Excel::download(new DataSurveyExport($id), 'hola.xlsx');
    }

    // public function cetakResumeDataSurvei($id)
    // {
    //     $data = DataSurvey::with(['user', 'konstruksiJalan', 'konstruksiSaluran', 'kecamatan', 'fasos.jenisFasos', 'lampiranFoto.jenisLampiran'])->where('kecamatan_id', $id)->groupBy('lokasi')->get();
    //     dd($data);
    //     // fasos
    //     if ($data[0]->fasos === 1) {
    //         $fasos = $data[0]->jenisFasos;
    //     } else {
    //         $fasos = 0;
    //     }
    //     $pdf = app('dompdf.wrapper');

    //     //############ if image are not loading execute this code ################################
    //     $contxt = stream_context_create([
    //         'ssl' => [
    //             'verify_peer' => FALSE,
    //             'verify_peer_name' => FALSE,
    //             'allow_self_signed' => TRUE,
    //         ]
    //     ]);
    //     // jika erorr
    //     // jalankan di terminal
    //     // composer require barryvdh/laravel-dompdf
    //     $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
    //     $pdf->getDomPDF()->setHttpContext($contxt);
    //     //#################################################################################

    //     //Cargar vista/tabla html y enviar varibles con la data
    //     $pdf->loadView('admin.data-survei.detail-data-survei', [
    //         'title' => 'Data Survei',
    //         'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
    //         'data' => $data[0],
    //         'fasos' => $fasos,
    //     ]);
    //     //descargar la vista en formato pdf 
    //     return $pdf->download($data[0]->nama_gang . ".pdf");
    // }

    public function cetakDetailDataSurvei($id)
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
        $pdf = PDF::setOptions(['isHTML5ParserEnabled' => true, 'isRemoteEnabled' => true]);
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

    public function destroyDataSurvei(Request $request)
    {
        try {
            DataSurvey::destroy($request->id);
            return redirect()->back()
                ->with('success', 'Berhasil Menghapus Data Survei');
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Gagal Menghapus Data Survei');
        }
    }
}
