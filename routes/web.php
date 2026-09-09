<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\MinistryController;
use App\Http\Controllers\Admin\MinistryMemberController;
use App\Http\Controllers\Admin\JemaatController;
use App\Http\Controllers\Admin\WorshipScheduleController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\GalleryController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\HomeController;



Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/ulang-tahun', [HomeController::class, 'birthdays'])
    ->name('birthdays');
Route::get('/berita', [HomeController::class, 'news'])
    ->name('news');
Route::get('/event', [HomeController::class, 'events'])
    ->name('events');
Route::get('/penatalayan', [HomeController::class, 'penatalayan'])
    ->name('penatalayan');
Route::get('/galeri', [HomeController::class, 'gallery'])
    ->name('gallery');
Route::get('/galeri/{album}', [HomeController::class, 'galleryShow'])
    ->name('gallery.show');
Route::get('/jadwal-ibadah', [HomeController::class, 'worshipSchedules'])
    ->name('worship-schedules');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';


Route::get('/admin', function () {
   return view('admin.dashboard');
})->middleware(['auth', 'admin']);


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {
       Route::get('/', [DashboardController::class, 'index'])
         ->name('dashboard');

        Route::resource('ministries', MinistryController::class);
        Route::resource('ministry-members', MinistryMemberController::class);
        Route::resource('jemaats', JemaatController::class);
        Route::resource('worship-schedules', WorshipScheduleController::class);
        Route::resource('news', NewsController::class);
        Route::resource('events', EventController::class);

        Route::resource('galleries', GalleryController::class);
        Route::post('galleries/{gallery}/photos', [GalleryController::class, 'addPhotos'])
            ->name('galleries.photos.store');
        Route::delete('galleries/{gallery}/photos/{photo}', [GalleryController::class, 'deletePhoto'])
            ->name('galleries.photos.destroy');
    });
   

