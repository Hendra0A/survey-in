<?php

namespace App;

use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('login');
});
//beranda
Route::get('/beranda', [AdminController::class, 'beranda']);
// pengelolaan surveyor
Route::get('/surveyor', [AdminController::class, 'surveyor']);
Route::get('/surveyor/tambah', function () {
    $data = [
        'active' => 'surveyor',
        'title' => 'Surveyor - Tambah Surveyor',
        'profile' => User::where('role', 'admin')->get(['nama_lengkap', 'avatar'])[0],
        'kabupaten' => Kabupaten::all('id', 'nama')
    ];
    return view('admin.surveyor.tambah', $data);
});
Route::post('/surveyor/tambah', [AdminController::class, 'tambahSurveyor']);
Route::put('/surveyor/hapus', [AdminController::class, 'destroySuyveyor']);
Route::put('/surveyor/update', [AdminController::class, 'updateSurveyor']);
Route::put('/surveyor/edit', [AdminController::class, 'getSurveyor']);
Route::post('/surveyor/profile/', [AdminController::class, 'surveyorProfile']);
Route::post('/surveyor/tambah-target', [AdminController::class, 'addSurveyorTarget']);
Route::post('/surveyor/edit-target', [AdminController::class, 'editSurveyorTarget']);
Route::post('/surveyor/target/', [AdminController::class, 'surveyorTarget']);



// Profile Admin
Route::get('/profile/{User:id}', [AdminController::class, 'profile']);
Route::get('/profile', [AdminController::class, 'profile']);
Route::get('/profile/edit-profile/admin', [AdminController::class, 'profileEdit']);
Route::patch('/profile/edit-profile/admin', [AdminController::class, 'profileUpdate']);

// Halaman Pengaturan Admin
Route::get('/pengaturan', [AdminController::class, 'pengaturan']);
Route::get('/pengaturan/edit-data-survey', [AdminController::class, 'editDataSurvey']);
Route::put('/pengaturan/edit-data-survey', [AdminController::class, 'editData']);
Route::post('/pengaturan/edit-data-survey/{model}/tambah', [AdminController::class, 'createData']);
Route::put('/pengaturan/edit-data-survey/hapus/', [AdminController::class, 'destroy']);
Route::get('/pengaturan/ubah-password', [AdminController::class, 'ubahPassword']);
Route::post('/pengaturan/ubah-password', [AdminController::class, 'updatePassword']);

// Halaman Data Survei
Route::get('/data-survei', [AdminController::class, 'dataSurvei'])->name('data-survei');
// Route::post('data-survei', [AdminController::class, 'getData'])->name('get-data');

Route::get('/data-survei/print/resume/{id}', [AdminController::class, 'cetakResumeDataSurvei']);
Route::get('/data-survei/print/{id}', [AdminController::class, 'cetakDetailDataSurvei']);
Route::get('/data-survei/{id}', [AdminController::class, 'detailDataSurvei']);
Route::put('/data-survei', [AdminController::class, 'destroyDataSurvei']);
