<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});





Route::get('/dashboard', function () {
    return view('dashboard');
    Route::get('/search/carte', [UserController::class, 'create'])->name('search.create');
    Route::post('/search/store', [UserController::class, 'store'])->name('search.store');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/search/carte', [UserController::class, 'carte'])->name('search.carte');
    Route::post('/search/store', [UserController::class, 'store'])->name('search.store');
    Route::get('/dashboard', [UserController::class, 'index'])->name('dashboard');
    Route::get('/departement/{departement}', [UserController::class, 'afficherDepartement'])->name('departement');


});



require __DIR__.'/auth.php';

Route::get('/{user}', [PublicController::class, 'index'])->name('public.index');
Route::get('/{user}/{article}', [PublicController::class, 'show'])->name('public.show');
Route::post('/comments/store', [CommentController::class, 'store'])->name('comments.store');
