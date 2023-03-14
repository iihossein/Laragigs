<?php

use App\Models\Listing;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ListingController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

// All Listings
Route::get('/', [ListingController::class, 'index']);

// Show Create Form
Route::get('listings/create', [ListingController::class, 'create'])
    ->middleware('auth')
    ->name('listings.create');

// Store Listing Data
Route::post('listings', [ListingController::class, 'store'])
    ->name('listings.store')
    ->middleware('auth');

// Show Edit Form
Route::get('listings/{listing}/edit', [ListingController::class, 'edit'])
    ->middleware('auth')
    ->where('listing', '[0-9]+')
    ->name('listing.edit');

// Update Listing
Route::put('listings/{listing}', [ListingController::class, 'update'])
    ->middleware('auth')
    ->where('listing', '[0-9]+')
    ->name('listing.update');
// Delete Listing
Route::delete('listings/{listing}', [ListingController::class, 'destroy'])
    ->middleware('auth')
    ->name('listing.delete');

// Single Listing
Route::get('listings/{listing}', [ListingController::class, 'show'])
    ->where('listing', '[0-9]+')
    ->name('listing.show');

// Manage Listing
Route::get('/listings/manage', [ListingController::class, 'manage'])
    ->middleware('auth');

// Show Register/Create Form
Route::get('/register', [UserController::class, 'create'])
    ->name('user.create')
    ->middleware('guest');

// Create New User
Route::post('/users', [UserController::class, 'store']);

// Log User Out
Route::post('/logout', [UserController::class, 'logout'])->middleware('auth');

// Show Login form
Route::get('login', [UserController::class, 'login'])
    ->name('login')
    ->middleware('guest');

// Log In User
// authenticate User
Route::post('/users/authenticate', [UserController::class, 'authenticate']);

// Manage Listing
Route::get('/listings/manage', [ListingController::class, 'manage']);
