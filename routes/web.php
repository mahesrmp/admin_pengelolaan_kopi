<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\PanenController;
use App\Http\Controllers\PascaController;
use App\Http\Controllers\MinumanController;
use App\Http\Controllers\BudidayaController;
use App\Http\Controllers\KomunitasController;
use App\Http\Controllers\PengajuanController;
use App\Http\Controllers\FasilitatorController;
use App\Http\Middleware\RedirectIfAuthenticated;

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


// Route::middleware([RedirectIfAuthenticated::class . ':admin,fasilitator'])->group(function () {
// });
Route::get('/', [AuthController::class, 'login'])->name('login');
Route::post('/login', [AuthController::class, 'proseslogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware(['auth', 'role:fasilitator'])->group(function () {
    Route::get('/fasilitator/dashboard', [FasilitatorController::class, 'dashboard'])->name('dashboard.fasilitator');
});

Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', [AuthController::class, 'dashboard'])->name('dashboard.admin');
    Route::get('/dashboard', function () {
        return view('layouts.dashboard', [
            'title' => 'Dashboard'
        ]);
    })->name('dashboard');

    Route::get('/budidaya', [BudidayaController::class, 'index']);
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
    Route::resource('minuman', MinumanController::class)->names([
        'index' => 'minuman.index',
    ]);
    Route::resource('komunitas', KomunitasController::class)->names([
        'index' => 'komunitas.index',
    ]);
    Route::get('penjualan', [BudidayaController::class, 'penjualan_index'])->name('penjualan.index');
    Route::get('/pengajuan', [PengajuanController::class, 'index'])->name('pengajuan.index');

    Route::post('/pengajuan/accept/{id}', [PengajuanController::class, 'accept'])->name('pengajuan.accept');
    Route::post('/pengajuan/reject/{id}', [PengajuanController::class, 'reject'])->name('pengajuan.reject');

    Route::get('data_user', [PengajuanController::class, 'get_data_user'])->name('getDataUser');
    Route::put('/user/{id}/deactivate', [PengajuanController::class, 'deactivate'])->name('user.deactivate');
    Route::delete('/user/{id}', [PengajuanController::class, 'delete'])->name('user.destroy');
    Route::put('/user/{id}/activate', [PengajuanController::class, 'activate'])->name('user.activate');
    Route::get('/user/{id}/edit', [PengajuanController::class, 'edit'])->name('user.edit');
    Route::get('/budidaya/{id}', [BudidayaController::class, 'show'])->name('budidaya.show');
    Route::get('/panen/{id}', [PanenController::class, 'show'])->name('panen.show');
    Route::get('/pascas/{id}', [PascaController::class, 'show'])->name('pasca.show');
});
