<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ListingController;
use App\Http\Controllers\RevisorController;

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

Route::get('/', [ListingController::class, 'index'])->name('home');
Route::get('listing/images', [ListingController::class, 'getImages'])->name('listing.images');
Route::get('/listing/create', [ListingController::class, 'create'])->name('listing.create');
Route::post('/listing/store', [ListingController::class, 'store'])->name('listing.store');

Route::get('/listing/{category}', [ListingController::class, 'getByCategory'])->name('listing.getByCategory');
Route::get('listing/show/{listing}', [ListingController::class, 'show'])->name('listing.show');
Route::get('/search', [ListingController::class, 'search'])->name('search');
Route::get('/listing/revisor/home', [RevisorController::class, 'index'])->name('revisor.home');
Route::post('/revisor/listing/{id}/accept', [RevisorController::class, 'accept'])->name('revisor.accept');
Route::post('/revisor/listing/{id}/reject', [RevisorController::class, 'reject'])->name('revisor.reject');
Route::get('/workWithUs', [ContactController::class, 'contact'])->name('workWithUs');
Route::post('/workWithUs/index', [ContactController::class, 'index'])->name('index');

Route::post('listing/images/upload', [ListingController::class, 'uploadImages'])->name('listing.images.upload');
Route::delete('listing/images/remove', [ListingController::class, 'removeImages'])->name('listing.images.remove');

Route::post('/locale/{locale}', [ListingController::class, 'locale'])->name('locale');





