<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PetController;
use App\Http\Controllers\PetsitterAdvertController;
use App\Http\Controllers\PetsitterAdvertResponseController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdvertResponseController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChirpController;

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

Route::get('/', function () {
    return redirect('/dashboard');
});

Route::get('dashboard', [AdvertResponseController::class, 'dashboard'])->name('dashboard')->middleware('auth', 'verified');

Route::resource('chirps', ChirpController::class)
    ->middleware(['auth', 'verified']);

// admin
Route::get('admin', [AdminController::class, 'dashboard'])->name('admin')->middleware('auth', 'verified');
Route::post('admin/block/{user}', [AdminController::class, 'block'])->name('admin.block')->middleware('auth', 'verified');

Route::middleware('auth')->group(function () {
    // profile routes
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::post('/profile', [ProfileController::class, 'uploadProfilePicture'])->name('profile.uploadProfilePicture');

    // pet routes
    Route::get('/pets/{pet}/respond', [PetController::class, 'respond'])->name('pets.respond');
    Route::get('/my-pets', [PetController::class, 'myPets'])->name('pets.my-pets');
    Route::resource('pets', PetController::class);

    // advert-responses routes
    Route::put('/advert-responses/{advertResponse}/accept', [AdvertResponseController::class, 'accept'])->name('advert-responses.accept');
    Route::put('/advert-responses/{advertResponse}/deny', [AdvertResponseController::class, 'deny'])->name('advert-responses.deny');
    Route::resource('advert-responses', AdvertResponseController::class);

    // pet-sitter routes
    Route::get('/petsitter-adverts/{petsitterAdvert}/respond', [PetsitterAdvertController::class, 'respond'])->name('petsitter-adverts.respond');
    Route::put('/petsitter-adverts/{advertResponse}/review', [PetsitterAdvertController::class, 'review'])->name('petsitter-adverts.review');
    Route::resource('petsitter-adverts', PetsitterAdvertController::class);

    // petsitter-advert-responses routes
    Route::put('/petsitter-advert-responses/{petsitterAdvertResponse}/accept', [PetsitterAdvertResponseController::class, 'accept'])->name('petsitter-advert-responses.accept');
    Route::put('/petsitter-advert-responses/{petsitterAdvertResponse}/deny', [PetsitterAdvertResponseController::class, 'deny'])->name('petsitter-advert-responses.deny');
    Route::resource('petsitter-advert-responses', PetsitterAdvertResponseController::class);
});

require __DIR__ . '/auth.php';
