<?php

use App\Http\Middleware\IsDokter;
use App\Http\Middleware\IsPemilik;

use App\Http\Middleware\IsPerawat;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\IsResepsionis;
use App\Http\Controllers\HomeController;
use App\Http\Middleware\IsAdministrator;
use App\Http\Controllers\Admin\PetController;
use App\Http\Controllers\Site\SiteController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\PemilikController;
use App\Http\Controllers\Admin\KategoriController;

use App\Http\Controllers\Admin\RasHewanController;
use App\Http\Controllers\Admin\JenisHewanController;
use App\Http\Controllers\Admin\DashboardAdminController;
use App\Http\Controllers\Admin\KategoriKlinisController;

use App\Http\Controllers\Dokter\DashboardDokterController;
use App\Http\Controllers\Admin\KodeTindakanTerapiController;
use App\Http\Controllers\Pemilik\DashboardPemilikController;
use App\Http\Controllers\Perawat\DashboardPerawatController;
use App\Http\Controllers\Resepsionis\DashboardResepsionisController;
use App\Models\Kategori;
use App\Models\KodeTindakanTerapi;
use App\Models\Pemilik;

Route::get('/', [SiteController::class, 'index'])->name('site.home');
Route::get('/cek-koneksi', [SiteController::class, 'cekKoneksi'])->name('site.cek-koneksi');

Route::get('/struktur', [HomeController::class, 'struktur'])->name('struktur');
Route::get('/layanan', [HomeController::class, 'layanan'])->name('layanan');
Route::get('/visi', [HomeController::class, 'visi'])->name('visi');
Route::get('/dashboard', [HomeController::class, 'index'])->name('dashboard');

Auth::routes();

Route::get('/logout', function () {
    Auth::logout();
    return redirect('/login');
})->name('logout');

Route::middleware([IsAdministrator::class])->group(function () {
    Route::get('/admin/dashboard', [DashboardAdminController::class, 'index'])->name('admin.dashboard');
    Route::get('/admin/jenis-hewan', [JenisHewanController::class, 'index'])->name('admin.jenis-hewan.index');
    Route::get('/jenis-hewan/create', [App\Http\Controllers\Admin\JenisHewanController::class, 'create'])->name('jenis-hewan.create');
    Route::get('/jenis-hewan/store', [App\Http\Controllers\Admin\JenisHewanController::class, 'store'])->name('jenis-hewan.store');
    Route::get('/admin/ras-hewan', [RasHewanController::class, 'index'])->name('admin.ras-hewan.index');
    Route::get('/admin/kategori', [KategoriController::class, 'index'])->name('admin.kategori.index');
    Route::get('/admin/kategori-klinis', [KategoriKlinisController::class, 'index'])->name('admin.kategori-klinis.index');
    Route::get('/admin/kode-tindakan-terapi', [KodeTindakanTerapiController::class, 'index'])->name('admin.kode-tindakan-terapi.index');
    Route::get('/admin/pet', [PetController::class, 'index'])->name('admin.pet.index');
    Route::get('/admin/role', [RoleController::class, 'index'])->name('admin.role.index');
    Route::get('/admin/user', [UserController::class, 'index'])->name('admin.user.index');
    Route::get('/admin/pemilik', [PemilikController::class, 'index'])->name('admin.pemilik.index');
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('jenis-hewan', JenisHewanController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori', KategoriController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kategori-klinis', KategoriKlinisController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('kode-tindakan-terapi', KodeTindakanTerapiController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pemilik', PemilikController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('pet', PetController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('ras-hewan', RasHewanController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('role', RoleController::class);
});

Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('user', UserController::class);
});

Route::middleware([IsDokter::class])->group(function () {
    Route::get('/dokter/dashboard', [DashboardDokterController::class, 'index'])->name('dokter.dashboard');
});

Route::middleware([IsPerawat::class])->group(function () {
    Route::get('/perawat/dashboard', [DashboardPerawatController::class, 'index'])->name('perawat.dashboard');
});

Route::middleware([IsResepsionis::class])->group(function () {
    Route::get('/resepsionis/dashboard', [DashboardResepsionisController::class, 'index'])->name('resepsionis.dashboard');
});

Route::middleware([IsPemilik::class])->group(function () {
    Route::get('/pemilik/dashboard', [DashboardPemilikController::class, 'index'])->name('pemilik.dashboard');
    Route::get('/pemilik/pet', [PetController::class, 'index'])->name('pemilik.pet.index');

});
