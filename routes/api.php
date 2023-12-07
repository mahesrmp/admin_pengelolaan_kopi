<?php

use App\Http\API\AuthController;
use Illuminate\Http\Request;
use App\Http\API\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\API\BudidayaAPIController;

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
Route::get('/budidaya/syarat_tumbuh', [BudidayaAPIController::class, 'getSyaratTumbuhData']);
Route::get('/budidaya/pola_tanam', [BudidayaAPIController::class, 'getPolaTanamData']);
Route::get('/budidaya/pohon_pelindung', [BudidayaAPIController::class, 'getPohonPelindungData']);
Route::get('/budidaya/pembibitan', [BudidayaAPIController::class, 'getPembibitanData']);
Route::get('/budidaya/pemupukan', [BudidayaAPIController::class, 'getPemupukanData']);
Route::get('/budidaya/pemangkasan', [BudidayaAPIController::class, 'getPemangkasanData']);
Route::get('/budidaya/hama_penyakit', [BudidayaAPIController::class, 'getHamaPenyakitData']);
Route::get('/budidaya/sanitasi_kebun', [BudidayaAPIController::class, 'getSanitasiKebunData']);
Route::get('/budidaya/tahapan', [BudidayaAPIController::class, 'select_tahapan']);

//PANEN
Route::get('/panen', [BudidayaAPIController::class, 'panen']);
Route::get('/panen/ciri_buah_kopi', [BudidayaAPIController::class, 'getCiriBuahKopiData']);
Route::get('/panen/pemetikan', [BudidayaAPIController::class, 'getPemetikanData']);

//PASCA PANEN
Route::get('/pasca/fermentasi_kering', [BudidayaAPIController::class, 'getFermentasiKeringData']);
Route::get('/pasca/fermentasi_mekanis', [BudidayaAPIController::class, 'getFermentasiMekanisData']);

//KEDAI
Route::get('/kedai', [BudidayaAPIController::class, 'getKedaiData']);


Route::post('/pengajuantambah', [PengajuanController::class, 'tambahData']);

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);
