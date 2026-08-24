<?php

use App\Http\Controllers\ListingController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;


// Register user
Route::get('/register', [UserController::class, 'create'])->name('register');

// Login user
Route::get('/login', [UserController::class, 'create'])->name('login');

// Create User
Route::post('/users', [UserController::class, 'store']);



// All listings
Route::get('/', [ListingController::class, 'index'])->name('listings.index');

// Show create form
Route::get('/listings/create', [ListingController::class, 'create'])->name('listings.create');

// Store Listing
Route::post('/listings', [ListingController::class, 'store'])->name('listings.store');

//  Show edit form
Route::get('/listings/{listing}/edit', [ListingController::class, 'edit'])->name('listing.edit');

// Update listing
Route::put('/listings/{listing}', [ListingController::class, 'update'])->name('listing.update');

// Single listing
Route::get('/listings/{listing}', [ListingController::class, 'show'])->name('listing.show');

// Delete listing
Route::delete('/listings/{listing}', [ListingController::class, 'destroy'])->name('listing.delete');
