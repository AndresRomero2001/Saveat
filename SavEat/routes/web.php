<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RestaurantController;
use App\Http\Controllers\TagController;
use App\Models\Restaurant;



Route::middleware('auth')->group(function () {
    Route::get('/', [RestaurantController::class, 'index'])->name('restaurants.index');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/restaurants', [RestaurantController::class, 'index'])->name('restaurants.index');
    Route::get('/restaurants/create', [RestaurantController::class, 'create'])->name('restaurants.create');
    Route::get('/restaurants/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('restaurants.edit');

    Route::get('/tags', [TagController::class, 'index'])->name('tags.index');
});

Route::get('/offline', function () {
    return view('offline');
});

require __DIR__.'/auth.php';
