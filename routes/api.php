<?php

use App\Http\API\ArtikelController;
use App\Http\API\AuthController;
use Illuminate\Http\Request;
use App\Http\API\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\API\BudidayaAPIController;
use App\Http\API\PermintaanPembelianController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//BUDIDAYA
// Route::get('/budidaya', [BudidayaAPIController::class, 'index']);
Route::get('/budidaya/pemilihan_lahan', [BudidayaAPIController::class, 'getPemilihanLahanData']);
Route::get('/budidaya/kesesuaian_lahan', [BudidayaAPIController::class, 'getKesesuaianLahanData']);
Route::get('/budidaya/persiapan_lahan', [BudidayaAPIController::class, 'getPersiapanLahanData']);
Route::get('/budidaya/penanaman_penaung', [BudidayaAPIController::class, 'getPenanamanPenaungData']);
Route::get('/budidaya/bahan_tanam_unggul+', [BudidayaAPIController::class, 'getBahanTanamUnggulData']);
Route::get('/budidaya/pembibitan', [BudidayaAPIController::class, 'getPembibitanData']);
Route::get('/budidaya/penanaman', [BudidayaAPIController::class, 'getPenanamanData']);
Route::get('/budidaya/pemupukan', [BudidayaAPIController::class, 'getPemupukanData']);
Route::get('/budidaya/pemangkasan', [BudidayaAPIController::class, 'getPemangkasanData']);
Route::get('/budidaya/pengelolaan_penaung', [BudidayaAPIController::class, 'getPengelolaanPenaungData']);
Route::get('/budidaya/pengendalian_hama', [BudidayaAPIController::class, 'getPengendalianHamaData']);
Route::get('/budidaya/tahapan', [BudidayaAPIController::class, 'select_tahapan']);

//PANEN
Route::get('/panen', [BudidayaAPIController::class, 'panen']);
Route::get('/panen/ciri_buah_kopi', [BudidayaAPIController::class, 'getCiriBuahKopiData']);
Route::get('/panen/pemetikan', [BudidayaAPIController::class, 'getPemetikanData']);
Route::get('/panen/sortasi_buah', [BudidayaAPIController::class, 'getSortasiBuahData']);

//PASCA PANEN
Route::get('/pasca/fermentasi_kering', [BudidayaAPIController::class, 'getFermentasiKeringData']);
Route::get('/pasca/fermentasi_mekanis', [BudidayaAPIController::class, 'getFermentasiMekanisData']);

//KEDAI
Route::get('/kedai', [BudidayaAPIController::class, 'getKedaiData']);

//PENGAJUAN
Route::get('/pengajuan', [PengajuanController::class, 'getPengajuanData']);
Route::get('/pengajuan_status/{id}', [PengajuanController::class, 'getPengajuanStatusData']);
Route::post('/pengajuantambah', [PengajuanController::class, 'tambahData']);

//KOMUNITAS
Route::get('/komunitas', [BudidayaAPIController::class, 'getKomunitasData']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

//Permintaan Pembelian
Route::get('permintaan_pembelian', [PermintaanPembelianController::class, 'index']);
Route::post('permintaan_pembelian', [PermintaanPembelianController::class, 'store']);

Route::get('artikel', [ArtikelController::class, 'index']);
Route::post('artikel', [ArtikelController::class, 'store']);
