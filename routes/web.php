<?php

namespace App;

use App\Models\User;
use App\Models\Kabupaten;
use Illuminate\Routing\RouteGroup;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\AccessController;
use App\Http\Controllers\SurveyorController;
use App\Http\Controllers\DataSurveyController;

Route::get('/', [AccessController::class, 'index'])->name('login');
Route::post('/', [AccessController::class, 'authenticate']);
Route::post('/logout', [AccessController::class, 'logout']);

//beranda
Route::get('/beranda', [AdminController::class, 'beranda']);
Route::get('/surveyor', [AdminController::class, 'surveyor']);

Route::get('/surveyor/tambah', [AdminController::class, 'Surveyortambah']);

Route::post('/surveyor/tambah', [AdminController::class, 'tambahSurveyor']);
Route::put('/surveyor/hapus', [AdminController::class, 'destroySuyveyor']);
Route::put('/surveyor/update', [AdminController::class, 'updateSurveyor']);
Route::put('/surveyor/edit', [AdminController::class, 'getSurveyor']);
Route::get('/surveyor/profile/{id}', [AdminController::class, 'surveyorProfile']);
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
Route::get('/data-survei', [DataSurveyController::class, 'index'])->name('data-survei');
Route::get('/data-survei/{id}', [DataSurveyController::class, 'detail']);
Route::put('/data-survei', [DataSurveyController::class, 'destroy']);
Route::get('/data-survei/print/resume/{id}', [DataSurveyController::class, 'printResume']);
Route::get('/data-survei/resume/{id}', [DataSurveyController::class, 'previewResume']);
Route::get('/data-survei/print/{id}', [DataSurveyController::class, 'printPDF']);
// Route::post('data-survei', [AdminController::class, 'getData'])->name('get-data');



// Halaman User
Route::get('/user/beranda', [SurveyorController::class, 'index']);
Route::get('/user/pengaturan', [SurveyorController::class, 'pengaturan']);
Route::get('/user/pengaturan/edit-password', [SurveyorController::class, 'ubahPassword']);
Route::post('/user/pengaturan/edit-password', [SurveyorController::class, 'updatePassword']);
Route::get('/user/riwayat-survei', [SurveyorController::class, 'history']);
Route::get('/user/profile', [SurveyorController::class, 'show']);
Route::get('/user/profile/edit-profile/surveyor', [SurveyorController::class, 'update']);
Route::patch('/user/profile/edit-profile/surveyor', [SurveyorController::class, 'updateProfile']);
Route::get('/user/data-survei', [SurveyorController::class, 'dataSurvei']);
