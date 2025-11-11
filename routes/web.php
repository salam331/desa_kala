<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Route::get('/profil-desa', function () {
    return view('profil-desa');
});

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

Route::get('/layanan-publik', [App\Http\Controllers\LayananController::class, 'index'])->name('layanan.index');

Route::get('/potensi-desa', [App\Http\Controllers\PotensiController::class, 'index'])->name('potensi.index');

Route::get('/galeri-desa', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.index');

Route::get('/kontak-pengaduan', [App\Http\Controllers\KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak-pengaduan', [App\Http\Controllers\KontakController::class, 'store'])->name('kontak.store');

Route::get('/admin/dashboard', function () {
    return view('admin.dashboard');
})->middleware(['auth', 'verified'])->name('admin.dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('admin')->prefix('admin')->name('admin.')->group(function () {
        // Dashboard
        Route::get('/', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
        Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
        Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');
        Route::put('/password', [AdminController::class, 'changePassword'])->name('password.change');
        Route::get('/logs', [AdminController::class, 'logs'])->name('logs');

        // Manajemen Admin
        Route::get('/manage-admins', [AdminController::class, 'manageAdmins'])->name('manage-admins');
        Route::post('/manage-admins', [AdminController::class, 'createAdmin'])->name('manage-admins.create');
        Route::delete('/manage-admins/{id}', [AdminController::class, 'deleteAdmin'])->name('manage-admins.delete');

        // Pengaduan
        Route::get('/pengaduan', [AdminController::class, 'pengaduan'])->name('pengaduan');
        Route::post('/pengaduan/{id}/update-status', [AdminController::class, 'updatePengaduanStatus'])->name('pengaduan.update-status');

        // Welcome Elements Management
        Route::resource('welcome-elements', AdminController::class, [
            'names' => [
                'index' => 'welcome-elements.index',
                'create' => 'welcome-elements.create',
                'store' => 'welcome-elements.store',
                'show' => 'welcome-elements.show',
                'edit' => 'welcome-elements.edit',
                'update' => 'welcome-elements.update',
                'destroy' => 'welcome-elements.destroy',
            ]
        ]);

        // Berita Management
        Route::get('/berita', [AdminController::class, 'beritaIndex'])->name('berita.index');
        Route::get('/berita/create', [AdminController::class, 'beritaCreate'])->name('berita.create');
        Route::post('/berita', [AdminController::class, 'beritaStore'])->name('berita.store');
        Route::get('/berita/{id}/edit', [AdminController::class, 'beritaEdit'])->name('berita.edit');
        Route::put('/berita/{id}', [AdminController::class, 'beritaUpdate'])->name('berita.update');
        Route::delete('/berita/{id}', [AdminController::class, 'beritaDestroy'])->name('berita.destroy');
    });
});

require __DIR__.'/auth.php';
