<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\KedaiController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PascaController;
use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PengajuanController;

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
    return view('layouts.dashboard', [
        'title' => 'Dashboard'
    ]);
})->name('dashboard');

// Route::get('/budidaya', [BudidayaController::class, 'index']);
Route::resource('budidaya', BudidayaController::class)->names([
    'index' => 'budidaya.index',
]);
Route::post('budidaya/remove-image', [BudidayaController::class, 'removeImage'])->name('budidaya.removeImage');
Route::resource('panen', PanenController::class)->names([
    'index' => 'panen.index',
]);
Route::resource('pasca', PascaController::class)->names([
    'index' => 'pasca.index',
]);
Route::resource('kedai', KedaiController::class)->names([
    'index' => 'kedai.index',
]);
Route::resource('komunitas', KomunitasController::class)->names([
    'index' => 'komunitas.index', 
]);
Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');
