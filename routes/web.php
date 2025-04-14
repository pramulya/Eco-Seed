<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\DisplayCart;
use App\Http\Controllers\ProductController;

Route::get('/', function () {
  return view('welcome');
});



Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cart', DisplayCart::class);

// Marketplace Routes
Route::get('/marketplace', [ProductController::class, 'index'])->name('marketplace.index');
Route::get('/marketplace/{id}', [ProductController::class, 'show'])->name('marketplace.show');
Route::post('/marketplace', [ProductController::class, 'store'])->name('marketplace.store');
Route::get('/marketplace/{id}/edit', [ProductController::class, 'edit'])->name('marketplace.edit');
Route::put('/marketplace/{id}', [ProductController::class, 'update'])->name('marketplace.update');
Route::delete('/marketplace/{id}', [ProductController::class, 'destroy'])->name('marketplace.destroy');



