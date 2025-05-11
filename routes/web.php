<?php

use App\Http\Controllers\AnunciController;
use App\Http\Controllers\CategoryController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome');
})->name('home');

Route::get('dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::resource('anuncis', AnunciController::class)->middleware('auth');
Route::resource('categories', CategoryController::class)->middleware('auth');
Route::get('/filter-anuncis', [AnunciController::class, 'filterByCategory'])->name('anuncis.filter');
//Route::get('/search-anuncis', [AnunciController::class, 'getTrendingCategories'])->name('categories.trending');

require __DIR__.'/settings.php';
require __DIR__.'/auth.php';
