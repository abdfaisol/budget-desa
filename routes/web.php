<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Kontrolku;
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
Route::get('/', [Kontrolku::class, 'rootID']);
Route::get('/{iduser}', [Kontrolku::class, 'home'])->name('home');
Route::get('/api/dev01/{id}', [Kontrolku::class, 'apiGET']);
Route::get('/generateAPI', [Kontrolku::class, 'token']);

Route::get('/home', [Kontrolku::class, 'index'])->name('home');
Route::get('/login', [Kontrolku::class, 'login']);
Route::get('/logout', [Kontrolku::class, 'logout']);
Route::get('/list', [Kontrolku::class, 'list'])->name('list');
Route::post('/ceklogin', [Kontrolku::class, 'ceklogin']);

// PENGAJUAN CRUD
Route::get('/pengajuan', [Kontrolku::class, 'pengajuan'])->name('ajuk');
Route::get('/pengajuan/saya', [Kontrolku::class, 'pengajuanku'])->name('pengajuanku');

Route::get('/pengajuan/detail/{id}', [Kontrolku::class, 'detailPengajuan']);

Route::get('/pengajuan/detail/periksa/{id}', [Kontrolku::class, 'periksa']);
Route::get('/pengajuan/detail/tolak/{id}', [Kontrolku::class, 'tolak']);
Route::post('/pengajuan/detail/accept', [Kontrolku::class, 'accept']);

Route::get('/pengajuan/create', [Kontrolku::class, 'createPengajuan']);
Route::post('/pengajuan/insert', [Kontrolku::class, 'insertPengajuan']);


// CRUD ALOKASI
Route::get('/new/alokasi', [Kontrolku::class, 'insertAlokasi']);
Route::post('/insert/alokasi', [Kontrolku::class, 'insertDataAlokasi']);
Route::get('/alokasi/edit/{id}', [Kontrolku::class, 'editAlokasi']);
Route::post('/alokasi/update', [Kontrolku::class, 'updateAlokasi']);

Route::get('/list/detail/{id}', [Kontrolku::class, 'detailAlokasi'])->name('alokasi');

// CRUD Detail ALokasi
Route::get('/list/detail/{id}/create', [Kontrolku::class, 'createList']);
Route::post('/list/detail/{id}/insert', [Kontrolku::class, 'insertList']);
Route::get('/list/detail/{idlist}/edit', [Kontrolku::class, 'editList']);
Route::post('/list/detail/update', [Kontrolku::class, 'updateList']);

Route::get('/del/alokasi/{id}', [Kontrolku::class, 'delAlokasi']);
Route::get('/del/detailalokasi/{id}', [Kontrolku::class, 'delDetailAlokasi']);

Route::post('/insert', [Kontrolku::class, 'insert']);
Route::post('/update/updatedata', [Kontrolku::class, 'updatedata']);
Route::get('/update/{id}', [Kontrolku::class, 'update']);
Route::get('/del/{id}', [Kontrolku::class, 'del']);
Route::get('/halo/{halo}', function ($halo = 'kosong') {
$data = [
	"halo" => $halo,
	"judul" => "Coba coba"
];
    return view('haha', $data);
});
Route::get('/register', function () {
$data = [
	"judul" => "Mendaftar"
];
    return view('register', $data);
});
Route::get('/data', function () {
$data = [
	"judul" => "Data All"
];
    return view('getall', $data);
});