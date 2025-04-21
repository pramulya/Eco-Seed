<?php

use App\Livewire\Checkout;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\DisplayCart;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/donation-history', [DonationController::class, 'history'])->name('donation.history');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cart', DisplayCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');
