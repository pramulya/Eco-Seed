<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\DisplayCart;
use App\Http\Controllers\Campaign\CampaignController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cart', DisplayCart::class);

// Simplified campaign routes
Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
Route::get('/campaign/{campaign}/donate', [CampaignController::class, 'showDonationForm'])->name('campaign.donate');
Route::post('/campaign/donate', [CampaignController::class, 'processDonation'])->name('campaign.process-donation');
