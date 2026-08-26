<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

// All listings
Route::get('/', [ListingController::class, 'index'])->name('listings.index');

// Protected routes

Route::middleware('guest')->group(function () {
    // Register user
    Route::get('/register', [UserController::class, 'create'])->name('register');

    // Login user
    Route::get('/login', [UserController::class, 'login'])->name('login');

    // Create User
    Route::post('/users', [UserController::class, 'store']);


    // Authenticate user
    Route::post('/users/login', [UserController::class, 'authenticate']);
});

Route::middleware('auth')->group(function () {
    // Logout user
    Route::post('/logout', [UserController::class, 'logout']);

    // Show create form
    Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');

    // Store Listing
    Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');

    // Manage listings
    Route::get('/listings/manage', [ListingController::class, 'manage'])->name('listings.manage');

    //  Show edit form
    Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listing.edit');

    // Update listing
    Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listing.update');

    // Single listing
    Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listing.show');

    // Delete listing
    Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listing.delete');
});
