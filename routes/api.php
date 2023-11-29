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

Route::get('/budidaya', [BudidayaAPIController::class, 'index']);
Route::get('/budidaya/tahapan', [BudidayaAPIController::class, 'select_tahapan']);
Route::get('/panen', [BudidayaAPIController::class, 'panen']);

Route::prefix('pengajuan')->group(function () {
    Route::post('tambah', [PengajuanController::class, 'tambahData']);
});

Route::post('register', [AuthController::class, 'register']);
Route::post('login', [AuthController::class, 'login']);