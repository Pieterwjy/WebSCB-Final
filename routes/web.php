<?php

use App\Http\Controllers\PendetaAccountController;
use App\Http\Controllers\AdminAccountController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PendetaController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\MultimediaController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\PendetaPostController;
use App\Http\Controllers\LiveStreamController;
use App\Http\Controllers\WebTokenController;
use App\Models\Post;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

//Guest
Route::get('/', function () {
    return view('main.home.index',['title' => 'Halaman Utama']);
    })->name('index');;
Route::get('/about', function () {
    return view('main.about.index',['title' => 'Tentang Kami']);
    })->name('aboutus');;
    Route::get('/announcement',[PostController::class, 'indexGuest'])->name('announcement');
    Route::get('/announcement/{id}',[PostController::class, 'showGuest'])->name('show_pengumuman');
Route::get('/live',[LiveStreamController::class, 'showGuest'])->name('livestream');
Route::get('/address', function () {
    return view('main.address.index',['title' => 'Lokasi']);
    })->name('address');;

Route::post('tokenweb',WebTokenController::class,'store');



// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware(['auth','role:pendeta'])->group(function(){
    Route::get('/pendeta', function() {
        return view('pendeta.pendeta_dashboard',['title' => 'Pendeta Dashboard'],[PendetaController::class, 'PendetaDashboard']);
    })->name('pendeta.dashboard');;
    Route::get('/pendeta/pengumuman', function() {
        return view('pendeta.pendeta_pengumuman',['title' => 'Pendeta Pengumuman'],[PendetaController::class, 'PendetaPengumuman']);
    })->name('pendeta.pengumuman');;
    Route::get('/pendeta/logout', [PendetaController::class, 'PendetaLogout'])->name('pendeta.logout');;

    Route::resource('/pendeta/akun', PendetaAccountController::class)->names('pendeta.akun');
    Route::resource('/pendeta/pengumuman', PendetaPostController::class)->names('pendeta.pengumuman');
    Route::get('/pendeta/pengumuman/create/checkSlug',[PendetaPostController::class, 'checkSlug']);
});

Route::middleware(['auth','role:admin'])->group(function(){
    Route::get('/admin', function() {
        return view('admin.admin_dashboard',['title' => 'Admin Dashboard'],[AdminController::class, 'AdminDashboard']);
    })->name('admin.dashboard');;
    Route::get('/admin/pengumuman', function() {
        return view('admin.admin_pengumuman',['title' => 'Admin Pengumuman'],[AdminController::class, 'AdminPengumuman']);
    })->name('admin.pengumuman');;
    Route::get('/admin/logout', [AdminController::class, 'AdminLogout'])->name('admin.logout');;

    Route::resource('/admin/akun', AdminAccountController::class)->names('admin.akun');
    Route::resource('/admin/pengumuman', PostController::class)->names('admin.pengumuman');
    Route::get('/admin/pengumuman/create/checkSlug',[PostController::class, 'checkSlug']);
});

Route::middleware(['auth','role:multimedia'])->group(function(){
    Route::get('/multimedia', function() {
        return view('multimedia.multimedia_dashboard',['title' => 'Multimedia Dashboard'],[MultimediaController::class, 'MultimediaDashboard']);
    })->name('multimedia.dashboard');;
    Route::get('/multimedia/logout', [MultimediaController::class, 'MultimediaLogout'])->name('multimedia.logout');;

    Route::resource('/multimedia/livestream', LiveStreamController::class)->names('multimedia.livestream');
});

/*
web.php
Route::middleware(['auth','role:multimedia', 'role:pendeta'])->prefix('dashboard')->group(function(){
    Route::get('/multimedia')->middleware (role Multimedia)->name
}

navbar.blade.php
@auth(role==multimedia)
    <a href="{{ route('multimedia') }}"></a>
@endauth
*/


