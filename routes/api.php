<?php

use App\Http\API\ArtikelController;
use App\Http\API\AuthController;
use Illuminate\Http\Request;
use App\Http\API\PengajuanController;
use Illuminate\Support\Facades\Route;
use App\Http\API\BudidayaAPIController;
use App\Http\API\ForumController;
use App\Http\API\ReplyKomentarController;
use App\Http\Controllers\BudidayaController;

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
Route::get('/minuman', [BudidayaAPIController::class, 'getMinumanData']);

//PENGAJUAN
Route::get('/pengajuan', [PengajuanController::class, 'getPengajuanData']);
Route::get('/pengajuan_status/{id}', [PengajuanController::class, 'getPengajuanStatusData']);
Route::post('/pengajuantambah', [PengajuanController::class, 'tambahData']);

//KOMUNITAS
Route::get('/komunitas', [BudidayaAPIController::class, 'getKomunitasData']);


Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);

Route::get('artikel', [ArtikelController::class, 'index']);
Route::get('artikel/{id}', [ArtikelController::class, 'show']);
Route::post('artikel', [ArtikelController::class, 'store']);
Route::post('artikel/{id}', [ArtikelController::class, 'update']);
Route::delete('artikel/{id}', [ArtikelController::class, 'destroy']);
Route::post('artikel_comment/{id}', [ArtikelController::class, 'comment_artikel']);
Route::post('artikel_like/{id}', [ArtikelController::class, 'like_artikel']);
Route::post('artikel_dislike/{id}', [ArtikelController::class, 'dislike_artikel']);
Route::get('artikelByUser/{user_id}', [ArtikelController::class, 'articlesByUser']);

Route::get('forum', [ForumController::class, 'index']);
Route::get('forum/{id}', [ForumController::class, 'show']);
Route::post('forum', [ForumController::class, 'store']);
Route::post('forum/{id}', [ForumController::class, 'update']);
Route::delete('forum/{id}', [ForumController::class, 'destroy']);
Route::get('forumKomen/{forum_id}', [ForumController::class, 'get_comment_forum']);
Route::post('forum_comment/{forum_id}', [ForumController::class, 'comment_forum']);
Route::put('forum_comment_update/{id}', [ForumController::class, 'update_comment_forum']);
Route::delete('forum_comment_delete/{id}', [ForumController::class, 'delete_comment_forum']);
Route::post('forum_comment/{forum_id}', [ForumController::class, 'comment_forum']);
Route::post('forum_like/{forum_id}/{user_id}', [ForumController::class, 'like_forum']);
Route::post('forum_dislike/{forum_id}/{user_id}', [ForumController::class, 'dislike_forum']);

Route::get('/provinsi', [BudidayaAPIController::class, 'getProvinsi']);
Route::get('/provinces/{provinceId}/regencies', [BudidayaAPIController::class, 'getKabupaten']);

Route::get('/komentar/{komentar_id}/user/{user_id}/replies', [ReplyKomentarController::class, 'getRepliesByUserId']);
Route::post('/replies', [ReplyKomentarController::class, 'reply']);
Route::get('replies/{komentar_id}', [ReplyKomentarController::class, 'get_replies']);
Route::put('komentar/{komentar_id}/user/{user_id}/replies/{id}', [ReplyKomentarController::class, 'updateReplyByUserId']);
Route::delete('komentar/{komentar_id}/user/{user_id}/replies/{id}', [ReplyKomentarController::class, 'deleteReplyByUserId']);
