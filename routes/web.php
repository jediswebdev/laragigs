<?php

use App\Http\Controllers\ListingController;
use Illuminate\Support\Facades\Route;

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
