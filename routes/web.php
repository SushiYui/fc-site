<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Main\NewsController;
use App\Http\Controllers\Main\LiveController;
use App\Http\Controllers\Main\MVController;
use App\Http\Controllers\Main\ScheduleController;
use App\Http\Controllers\Main\BlogController;
use App\Http\Controllers\Main\BlogLikeController;
use App\Http\Controllers\Main\MovieController;
use App\Http\Controllers\Admin\Auth\RegisteredAdminController;
use App\Http\Controllers\Main\FanclubController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('admin')->group(function () {
    Route::get('register', [RegisteredAdminController::class, 'create'])->name('news.create');
    Route::post('register', [RegisteredAdminController::class, 'store'])->name('register.store');

    // お知らせ
    Route::get('/news/{id}/edit', [NewsController::class, 'edit'])->name('news.edit');
    Route::put('/news/{id}', [NewsController::class, 'update'])->name('news.update');
    Route::delete('/news/{id}', [NewsController::class, 'destroy'])->name('news.destroy');

    // ライブ情報
    Route::get('/lives/create', [LiveController::class, 'create'])->name('lives.create');
    Route::post('/lives', [LiveController::class, 'store'])->name('lives.store');
    Route::get('/lives/{id}/edit', [LiveController::class, 'edit'])->name('live.edit');
    Route::put('/lives/{id}', [LiveController::class, 'update'])->name('live.update');
    Route::delete('/lives/{id}', [LiveController::class, 'destroy'])->name('live.destroy');

    // MV一覧
    Route::get('/mv/create', [MVController::class, 'create'])->name('mv.create');
    Route::post('/mv', [MVController::class, 'store'])->name('mv.store');
    Route::get('/mv/{id}/edit', [MVController::class, 'edit'])->name('mv.edit');
    Route::put('/mv/{id}', [MVController::class, 'update'])->name('mv.update');
    Route::delete('/mv/{id}', [MVController::class, 'destroy'])->name('mv.destroy');

    // スケジュール
    Route::get('/schedules/create', [ScheduleController::class, 'create'])->name('schedules.create');
    Route::post('/schedules', [ScheduleController::class, 'store'])->name('schedules.store');
    Route::get('/schedules/{id}/edit', [ScheduleController::class, 'edit'])->name('schedules.edit');
    Route::put('/schedules/{id}', [ScheduleController::class, 'update'])->name('schedules.update');
    Route::delete('/schedules/{id}', [ScheduleController::class, 'destroy'])->name('schedules.destroy');

    // ブログ
    Route::get('/blogs/create', [BlogController::class, 'create'])->name('blogs.create');
    Route::post('/blogs', [BlogController::class, 'store'])->name('blogs.store');
    Route::get('/blogs/{id}/edit', [BlogController::class, 'edit'])->name('blogs.edit');
    Route::put('/blogs/{id}', [BlogController::class, 'update'])->name('blogs.update');
    Route::delete('/blogs/{id}', [BlogController::class, 'destroy'])->name('blogs.destroy');

    // movie
    Route::get('/movie/create', [MovieController::class, 'create'])->name('movies.create');
    Route::post('/movie', [MovieController::class, 'store'])->name('movies.store');
    Route::get('/movie/{id}/edit', [MovieController::class, 'edit'])->name('movies.edit');
    Route::put('/movie/{id}', [MovieController::class, 'update'])->name('movies.update');
    Route::delete('/movie/{id}', [MovieController::class, 'destroy'])->name('movies.destroy');

    // gallery
    Route::get('/gallery/create', [GalleryController::class, 'create'])->name('gallery.create');
    Route::post('/gallery', [GalleryController::class, 'store'])->name('gallery.store');
    Route::get('/gallery/{id}/edit', [GalleryController::class, 'edit'])->name('gallery.edit');
    Route::put('/gallery/{id}', [GalleryController::class, 'update'])->name('gallery.update');
    Route::delete('/gallery/{id}', [GalleryController::class, 'destroy'])->name('gallery.destroy');

});

// ファンクラブページへ遷移

Route::get('/dashboard', function () {
    return redirect()->route('fanclub.home');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/fanclub', [FanclubController::class, 'index'])->middleware(['auth'])->name('fanclub.home');

Route::middleware('auth')->group(function () {
// 一般会員向け：お知らせ一覧と詳細
    Route::get('/news', [NewsController::class, 'index'])->name('news.index');
    Route::get('/news/{id}', [NewsController::class, 'show'])->name('news.show');

// 一般会員向け：ライブ情報
    Route::get('/lives', [LiveController::class, 'index'])->name('lives.index');
    Route::get('/lives/{id}', [LiveController::class, 'show'])->name('lives.show');

// 一般会員向け：MV一覧ページ
    Route::get('/mv', [MVController::class, 'index'])->name('mv.index');
    Route::get('/mv/{id}', [MVController::class, 'show'])->name('mv.show');

// 一般会員向け：スケジュール一覧ページ
    Route::get('/schedules', [ScheduleController::class, 'index'])->name('schedules.index');
    Route::get('/schedules/{id}', [ScheduleController::class, 'show'])->name('schedules.show');

    // 一般会員向け：ブログ
    Route::get('/blogs', [BlogController::class, 'index'])->name('blogs.index');
    Route::get('/blogs/{id}', [BlogController::class, 'show'])->name('blogs.show');

    // 一般会員向け：movie
    Route::get('/movies', [MovieController::class, 'index'])->name('movies.index');
    Route::get('/movies/{id}', [MovieController::class, 'show'])->name('movies.show');

    // 一般会員向け：movie
    Route::get('/gallery', [GalleryController::class, 'index'])->name('gallery.index');
    Route::get('/gallery/{id}', [GalleryController::class, 'show'])->name('gallery.show');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //いいね
    Route::post('/blogs/{id}/like', [BlogLikeController::class, 'store']);
    Route::post('/blogs/{id}/like', [BlogLikeController::class, 'destroy']);

});

require __DIR__.'/auth.php';
