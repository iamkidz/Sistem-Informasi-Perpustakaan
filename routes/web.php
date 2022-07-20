<?php

use App\Http\Controllers\BukuController;
use App\Http\Controllers\DataHilangController;
use App\Http\Controllers\PeminjamanController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
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
    return view('beranda');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/contact', function () {
    return view('contact');
});

Auth::routes();

Route::get('login', function () {
    return redirect('/');
})->name('login');

Route::middleware('auth')->group(function () {
    Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    Route::resource('/buku', BukuController::class);
    Route::resource('/pinjam', PeminjamanController::class);
    Route::resource('/data-hilang', DataHilangController::class);
    Route::resource('/pengguna', UserController::class);

    Route::post('dikembalikan', [PeminjamanController::class, 'dikembalikan']);
    Route::post('persetujuan', [PeminjamanController::class, 'persetujuan']);
    Route::post('tambahstok', [BukuController::class, 'tambahstok']);
    Route::post('ubahpassword', [UserController::class, 'ubahpassword']);

    Route::post('import-buku', [BukuController::class, 'import']);


    Route::prefix('report')->group(function () {
        Route::get('buku', [ReportController::class, 'buku']);
        Route::get('pinjam', [ReportController::class, 'pinjam']);
        Route::get('hilang', [ReportController::class, 'hilang']);

        Route::get('per_buku/{id}', [ReportController::class, 'per_buku']);
        Route::get('per_pinjam/{id}', [ReportController::class, 'per_pinjam']);
        Route::get('per_hilang/{id}', [ReportController::class, 'per_hilang']);

        Route::get('buku_semua', [ReportController::class, 'buku_semua']);
        Route::get('pinjam_semua', [ReportController::class, 'pinjam_semua']);
        Route::post('pinjam_tahunan', [ReportController::class, 'pinjam_tahunan']);
        Route::post('pinjam_bulanan', [ReportController::class, 'pinjam_bulanan']);

        Route::get('hilang_semua', [ReportController::class, 'hilang_semua']);
        Route::post('hilang_tahunan', [ReportController::class, 'hilang_tahunan']);
        Route::post('hilang_bulanan', [ReportController::class, 'hilang_bulanan']);
    });
});
