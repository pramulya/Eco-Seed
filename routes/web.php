<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Livewire\DisplayCart;
use App\Livewire\Checkout;

Route::get('/', function () {
    return view('welcome');
});

// Donation
Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/donation-history', [DonationController::class, 'history'])->name('donation.history');

// Dashboard
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');

// Cart & Checkout
Route::get('/cart', DisplayCart::class)->name('cart');
Route::get('/checkout', Checkout::class)->name('checkout');

// Articles
Route::get('/news', [ArticleController::class, 'index'])->name('articles.index');
Route::get('/news/{id}', [ArticleController::class, 'show'])->name('articles.show');

// Campaigns
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
Route::get('/campaign/{campaign}/donate', [CampaignController::class, 'showDonationForm'])->name('campaign.donate');
Route::post('/campaign/donate', [CampaignController::class, 'processDonation'])->name('campaign.process-donation');
