<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\Data_magangController;
use App\Http\Controllers\DivisiController;
use App\Http\Controllers\InstansiController;
use App\Http\Controllers\LokasiPklController;
use App\Http\Controllers\PembimbingController;
use App\Http\Controllers\PresensiController;
use App\Http\Controllers\RegistrasiController;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::middleware(['guest:data_magang'])->group(function () {
    Route::get('/registrasi', [RegistrasiController::class,'index']);
    Route::post('/prosesregistrasi', [RegistrasiController::class,'registrasi']);
    Route::get('/', function () {
        return view('auth.login');
    })->name('login');
    Route::post('/proseslogin', [AuthController::class,'proseslogin']);
});

Route::middleware(['guest:user'])->group(function () {
    Route::get('/admin', function () {
        return view('auth.loginadmin');
    })->name('loginadmin');
    Route::post('/prosesloginadmin', [AuthController::class,'prosesloginadmin']);
});
Route::post('/izin_approved/{id}/{tgl_izin}/{approved}',[PresensiController::class,'approved']);

Route::middleware(['auth:data_magang'])->group(function () {
    Route::get('/dashboard', [DashboardController::class,'index']);
    Route::get('/viewpresensi', [DashboardController::class,'viewpresensi']);
    Route::get('/detailpresensi/{tgl}', [DashboardController::class,'detailpresensi']);
    Route::get('/proseslogout', [AuthController::class,'proseslogout']);
    //presensi
    Route::get('/presensi/create', [PresensiController::class,'create']);
    Route::post('/presensi/store', [PresensiController::class,'store']);
    //editprofile
    Route::get('/editprofile', [PresensiController::class,'editprofile']);
    Route::post('/presensi/{id_pkl}/updateprofile',[PresensiController::class,'updateprofile']);
    //histori
    Route::get('/presensi/histori', [PresensiController::class,'histori']);
    Route::post('/gethistori', [PresensiController::class,'gethistori']);
    Route::get('/presensi/detailhistori/{tgl}', [PresensiController::class,'detailhistori']);
    //izin
    Route::get('/presensi/izin', [PresensiController::class,'izin']);
    Route::get('/presensi/formizin', [PresensiController::class,'formizin']);
    Route::post('/presensi/storeizin', [PresensiController::class,'storeizin']);
});
Route::middleware(['auth:user'])->group(function () {
    Route::get('/proseslogoutadmin', [AuthController::class,'proseslogoutadmin']);
    Route::get('/admin/dashboard', [DashboardController::class,'dashboardadmin']);
    //data_magang
    Route::get('/admin/master/data_magang', [Data_magangController::class,'index']);
    Route::post('/admin/simpandata_magang', [Data_magangController::class,'simpandata']);
    Route::get('/admin/detaildata/{id_pkl}', [Data_magangController::class,'detaildata']);
    Route::get('/admin/hapusdata_magang/{id_pkl}', [Data_magangController::class, 'hapusDataMagang']);
    Route::get('/admin/editdata/{id_pkl}', [Data_magangController::class,'editdata']);
    Route::post('/admin/updatedata_magang', [Data_magangController::class,'updatedata_magang']);
    //data_user
    Route::get('/admin/master/data_user', [AdminController::class,'index']);
    Route::post('/admin/simpandata_user', [AdminController::class,'simpandata_user']);
    Route::get('/admin/hapusdata_user/{id}', [AdminController::class, 'hapusDatauser']);
    Route::get('/admin/editdata_user/{id}', [AdminController::class,'editdata_user']);
    Route::post('/admin/updatedata_user', [AdminController::class,'updatedata_user']);
    //data_divisi
    Route::get('/admin/master/data_divisi', [DivisiController::class,'index']);
    Route::post('/admin/simpandata_divisi', [DivisiController::class,'simpandata_divisi']);
    Route::get('/admin/hapusdata_divisi/{id_divisi}', [DivisiController::class, 'hapusDatadivisi']);
    Route::get('/admin/editdata_divisi/{id_divisi}', [DivisiController::class,'editdata_divisi']);
    Route::post('/admin/updatedata_divisi', [DivisiController::class,'updatedata_divisi']);

    //pembimbing
    Route::get('/admin/master/data_pl', [PembimbingController::class,'index']);
    Route::post('/admin/simpandata_pl', [PembimbingController::class,'simpandata_pl']);
    Route::get('/admin/hapusdata_pl/{id_pl}', [PembimbingController::class, 'hapusDatapl']);
    Route::get('/admin/editdata_pl/{id_pl}', [PembimbingController::class,'editdata_pl']);
    Route::post('/admin/updatedata_pl', [PembimbingController::class,'updatedata_pl']);

    //instansi
    Route::get('/admin/master/data_instansi', [InstansiController::class,'index']);
    Route::post('/admin/simpandata_instansi', [InstansiController::class,'simpandata_instansi']);
    Route::get('/admin/hapusdata_instansi/{id_instansi}', [InstansiController::class, 'hapusDataInstansi']);
    Route::get('/admin/editdata_instansi/{id_instansi}', [InstansiController::class,'editdata_instansi']);
    Route::post('/admin/updatedata_instansi', [InstansiController::class,'updatedata_instansi']);


    //lokasi_pkl
    Route::get('/admin/master/data_lokasipkl', [LokasiPklController::class,'index']);
    Route::post('/admin/simpandata_lokasi', [LokasiPklController::class,'simpandata_lokasi']);
    Route::get('/admin/hapusdata_lokasi/{id_lokasi}', [LokasiPklController::class, 'hapusDatalokasi']);
    Route::get('/admin/editdata_lokasi/{id_lokasi}', [LokasiPklController::class,'editdata_lokasi']);
    Route::post('/admin/updatedata_lokasi', [LokasiPklController::class,'updatedata_lokasi']);

    //monitoring
    Route::get('/admin/presensi/monitoring',[PresensiController::class,'monitoring']);
    Route::post('/getpresensi',[PresensiController::class,'getpresensi']);

    //histori
    Route::get('/admin/presensi/histori',[PresensiController::class,'presensihistori']);

    //laporan
    Route::get('/admin/presensi/laporan',[PresensiController::class,'laporan']);
    Route::post('/presensi/cetaklaporan',[PresensiController::class,'cetaklaporan']);

    //rekap
    Route::get('/admin/presensi/rekap',[PresensiController::class,'rekap']);
    Route::post('/presensi/cetakrekap',[PresensiController::class,'cetakrekap']);

    //data izin
    Route::get('/admin/presensi/data_izin',[PresensiController::class,'dataizin']);
    Route::post('/presensi/cetakizin',[PresensiController::class,'cetakizin']);
    Route::post('/admin/izinapproved',[PresensiController::class,'izinapproved']);
    Route::get('/admin/{id}/batalapproved',[PresensiController::class,'batalapproved']);



});

