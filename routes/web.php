<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\SettingController;
use App\Http\Controllers\Admin\PostController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\TeacherController;
use App\Http\Controllers\Admin\AchievementController;
use App\Http\Controllers\Admin\AnnouncementController;
use App\Http\Controllers\Admin\DownloadController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\PageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PostFrontController;
use App\Http\Controllers\PageFrontController;
use App\Http\Controllers\GalleryFrontController;
use App\Http\Controllers\TeacherFrontController;
use App\Http\Controllers\AchievementFrontController;
use App\Http\Controllers\AnnouncementFrontController;
use App\Http\Controllers\DownloadFrontController;
use App\Http\Controllers\SitemapController;

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/berita', [PostFrontController::class, 'index'])->name('berita.index');
Route::get('/berita/{slug}', [PostFrontController::class, 'show'])->name('berita.show');
Route::get('/page/{slug}', [PageFrontController::class, 'show'])->name('page.show');
Route::get('/galeri', [GalleryFrontController::class, 'index'])->name('galeri.index');
Route::get('/galeri/{slug}', [GalleryFrontController::class, 'show'])->name('galeri.show');
Route::get('/guru', [TeacherFrontController::class, 'index'])->name('guru.index');
Route::get('/prestasi', [AchievementFrontController::class, 'index'])->name('prestasi.index');
Route::get('/prestasi/{id}', [AchievementFrontController::class, 'show'])->name('prestasi.show');
Route::get('/pengumuman', [AnnouncementFrontController::class, 'index'])->name('pengumuman.index');
Route::get('/download', [DownloadFrontController::class, 'index'])->name('download.index');
Route::view('/ppdb', 'ppdb.index')->name('ppdb.index');
Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap');

Route::get('/admin', function () {
    return redirect()->route('admin.dashboard');
});

Route::get('/dashboard', function () {
    return redirect()->route('admin.dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth', 'verified'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    
    // Super Admin only
    Route::middleware('role:Super Admin')->group(function () {
        Route::resource('users', \App\Http\Controllers\Admin\UserController::class);
    });

    // Super Admin & Admin Sekolah only
    Route::middleware('role:Super Admin|Admin Sekolah')->group(function () {
        Route::get('/settings', [SettingController::class, 'index'])->name('settings.index');
        Route::post('/settings', [SettingController::class, 'update'])->name('settings.update');
        Route::resource('sliders', SliderController::class);
        Route::resource('pages', PageController::class);
    });

    // Editor, Admin Sekolah, Super Admin
    Route::middleware('role:Super Admin|Admin Sekolah|Editor')->group(function () {
        Route::resource('categories', CategoryController::class);
        Route::resource('posts', PostController::class);
        Route::resource('galleries', GalleryController::class);
        Route::delete('galleries/images/{image}', [GalleryController::class, 'destroyImage'])->name('galleries.images.destroy');
        Route::resource('teachers', TeacherController::class);
        Route::resource('achievements', AchievementController::class);
        Route::resource('announcements', AnnouncementController::class);
        Route::resource('downloads', DownloadController::class);
    });
});

require __DIR__.'/auth.php';
