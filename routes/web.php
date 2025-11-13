<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index']);

Route::get('/profil-desa', [App\Http\Controllers\ProfilDesaController::class, 'index'])->name('profil-desa');

Route::get('/berita', [App\Http\Controllers\BeritaController::class, 'index'])->name('berita.index');
Route::get('/berita/{id}', [App\Http\Controllers\BeritaController::class, 'show'])->name('berita.show');

Route::get('/layanan-publik', [App\Http\Controllers\LayananController::class, 'index'])->name('layanan.index');

Route::get('/potensi-desa', [App\Http\Controllers\PotensiController::class, 'index'])->name('potensi.index');

Route::get('/galeri-desa', [App\Http\Controllers\GaleriController::class, 'index'])->name('galeri.index');
Route::get('/galeri-desa/{id}', [App\Http\Controllers\GaleriController::class, 'show'])->name('galeri.show');

Route::get('/kontak-pengaduan', [App\Http\Controllers\KontakController::class, 'index'])->name('kontak.index');
Route::post('/kontak-pengaduan', [App\Http\Controllers\KontakController::class, 'store'])->name('kontak.store');



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

        // Profil Desa Management
        Route::get('/profil-desa', [AdminController::class, 'indexProfilDesa'])->name('profil-desa.index');
        Route::get('/profil-desa/edit', [AdminController::class, 'editProfilDesa'])->name('profil-desa.edit');
        Route::put('/profil-desa', [AdminController::class, 'updateProfilDesa'])->name('profil-desa.update');

        // Struktur Pemerintahan Management
        Route::get('/struktur-pemerintahan', [AdminController::class, 'indexStruktur'])->name('struktur-pemerintahan.index');
        Route::get('/struktur-pemerintahan/create', [AdminController::class, 'createStruktur'])->name('struktur-pemerintahan.create');
        Route::post('/struktur-pemerintahan', [AdminController::class, 'storeStruktur'])->name('struktur-pemerintahan.store');
        Route::get('/struktur-pemerintahan/{id}/edit', [AdminController::class, 'editStruktur'])->name('struktur-pemerintahan.edit');
        Route::put('/struktur-pemerintahan/{id}', [AdminController::class, 'updateStruktur'])->name('struktur-pemerintahan.update');
        Route::delete('/struktur-pemerintahan/{id}', [AdminController::class, 'destroyStruktur'])->name('struktur-pemerintahan.destroy');

        // Layanan Management
        Route::get('/layanan', [AdminController::class, 'layananIndex'])->name('layanan.index');
        Route::get('/layanan/create', [AdminController::class, 'layananCreate'])->name('layanan.create');
        Route::post('/layanan', [AdminController::class, 'layananStore'])->name('layanan.store');
        Route::get('/layanan/{id}/edit', [AdminController::class, 'layananEdit'])->name('layanan.edit');
        Route::put('/layanan/{id}', [AdminController::class, 'layananUpdate'])->name('layanan.update');
        Route::delete('/layanan/{id}', [AdminController::class, 'layananDestroy'])->name('layanan.destroy');

        // Potensi Management
        Route::get('/potensi', [AdminController::class, 'potensiIndex'])->name('potensi.index');
        Route::get('/potensi/create', [AdminController::class, 'potensiCreate'])->name('potensi.create');
        Route::post('/potensi', [AdminController::class, 'potensiStore'])->name('potensi.store');
        Route::get('/potensi/{id}/edit', [AdminController::class, 'potensiEdit'])->name('potensi.edit');
        Route::put('/potensi/{id}', [AdminController::class, 'potensiUpdate'])->name('potensi.update');
        Route::delete('/potensi/{id}', [AdminController::class, 'potensiDestroy'])->name('potensi.destroy');

        // Galeri Management
        Route::get('/galeri', [AdminController::class, 'galeriIndex'])->name('galeri.index');
        Route::get('/galeri/create', [AdminController::class, 'galeriCreate'])->name('galeri.create');
        Route::post('/galeri', [AdminController::class, 'galeriStore'])->name('galeri.store');
        Route::get('/galeri/{id}/edit', [AdminController::class, 'galeriEdit'])->name('galeri.edit');
        Route::put('/galeri/{id}', [AdminController::class, 'galeriUpdate'])->name('galeri.update');
        Route::delete('/galeri/{id}', [AdminController::class, 'galeriDestroy'])->name('galeri.destroy');
    });
});

require __DIR__ . '/auth.php';
