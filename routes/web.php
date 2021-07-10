<?php

use App\Http\Controllers\BankController;
use App\Http\Controllers\BusController;
use App\Http\Controllers\BusDetailController;
use App\Http\Controllers\HotelController;
use App\Http\Controllers\HotelDetailController;
use App\Http\Controllers\InfoController;
use App\Http\Controllers\JadwalController;
use App\Http\Controllers\JenisBusController;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LokasiController;
use App\Http\Controllers\NoteController;
use App\Http\Controllers\PaketController;
use App\Http\Controllers\PaketLokasiController;
use App\Http\Controllers\PembayaranController;
use App\Http\Controllers\PembayaranDetailController;
use App\Http\Controllers\PemesananController;
use App\Http\Controllers\PerusahaanController;
use App\Http\Controllers\PesawatController;
use App\Http\Controllers\PesawatDetailController;
use App\Models\Paket;
use App\Models\PaketLokasi;
use Illuminate\Support\Facades\Route;

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
		$pakets = Paket::all();
		$paket_lokasis = PaketLokasi::all();
    return view('welcome', compact('pakets','paket_lokasis'));
});

Route::get('/info/{id}', [InfoController::class, 'index'])->name('info.index');
Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Auth::routes();

Route::get('/home', 'App\Http\Controllers\HomeController@index')->name('home');

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'App\Http\Controllers\UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'App\Http\Controllers\ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'App\Http\Controllers\ProfileController@update']);
	Route::get('upgrade', function () {return view('pages.upgrade');})->name('upgrade'); 
	Route::get('map', function () {return view('pages.maps');})->name('map');
	Route::get('icons', function () {return view('pages.icons');})->name('icons'); 
	Route::get('table-list', function () {return view('pages.tables');})->name('table');
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'App\Http\Controllers\ProfileController@password']);

	Route::resources([
		'bus' => BusController::class,
		'bus_detail' => BusDetailController::class,
		'hotel' => HotelController::class,
		'hotel_detail' => HotelDetailController::class,
		'lokasi' => LokasiController::class,
		'pesawat' => PesawatController::class,
		'pesawat_detail' => PesawatDetailController::class,
		'paket' => PaketController::class,
		'pemesanan' => PemesananController::class,
		'pembayaran' => PembayaranController::class,
		'pembayaran_detail' => PembayaranDetailController::class,
		'jenis_bus' => JenisBusController::class,
		'paket_lokasi' => PaketLokasiController::class,
		'bank' => BankController::class,
		'perusahaan' => PerusahaanController::class,
		'note' => NoteController::class,
		'jadwal' => JadwalController::class
	]);

	Route::get('pemesanan/data/print/{kode}', [App\Http\Controllers\PemesananController::class, 'print'])->name('pemesanan.print');
	Route::get('pemesanan/data/detail/{id}', [App\Http\Controllers\PemesananController::class, 'detail'])->name('pemesanan.detail');
	Route::get('pembayaran/data/print/{kode}', [App\Http\Controllers\PembayaranController::class, 'print'])->name('pembayaran.print');
	Route::get('pembayaran_detail/data/print/{id}', [App\Http\Controllers\PembayaranDetailController::class, 'print'])->name('pembayaran_detail.print');
	Route::get('jadwal/by/paket/{id}', [JadwalController::class, 'get_jadwal_by_paket'])->name('jadwal.get_jadwal_by_paket');

	Route::get('laporan/pemesanan', [LaporanController::class, 'pemesanan'])->name('laporan.pemesanan');
});

