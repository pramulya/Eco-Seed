<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\DisplayCart;
use App\Http\Controllers\Campaign\CampaignController;
use App\Http\Controllers\VolunteerController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cart', DisplayCart::class);

// Simplified campaign routes
// Remove or comment out the duplicate import
// use App\Http\Controllers\VolunteerController;

// Add these volunteer routes with the existing routes
Route::get('/Volunteer', [VolunteerController::class, 'mainIndex'])->name('volunteer.main');
Route::get('/volunteer/{campaign_id}/create', [VolunteerController::class, 'create'])->name('volunteer.create');
Route::post('/volunteer', [VolunteerController::class, 'store'])->name('volunteer.store');
Route::get('/volunteer/{campaign_id}', [VolunteerController::class, 'index'])->name('volunteer.index');
Route::get('/campaigns', [CampaignController::class, 'index'])->name('campaigns.index');
Route::get('/campaigns/create', [CampaignController::class, 'create'])->name('campaigns.create');
Route::post('/campaigns', [CampaignController::class, 'store'])->name('campaigns.store');
Route::get('/campaigns/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaigns.edit');
Route::put('/campaigns/{campaign}', [CampaignController::class, 'update'])->name('campaigns.update');
Route::delete('/campaigns/{campaign}', [CampaignController::class, 'destroy'])->name('campaigns.destroy');
Route::get('/campaigns/{campaign}/donate', [CampaignController::class, 'showDonationForm'])->name('campaigns.donate');
Route::post('/campaigns/donate', [CampaignController::class, 'processDonation'])->name('campaigns.process-donation');

// Volunteer Routes (consolidated and fixed)
// Remove ALL existing volunteer routes and replace with:
// Ensure ONLY these volunteer routes are present:
Route::prefix('volunteer')->group(function () {
    Route::get('/{campaign_id}', [VolunteerController::class, 'index'])->name('volunteer.index');
    Route::get('/{campaign_id}/register', [VolunteerController::class, 'create'])->name('volunteer.register');
    Route::post('/{campaign_id}/store', [VolunteerController::class, 'store'])->name('volunteer.store');
});

Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
Route::get('/campaign/{campaign}/donate', [CampaignController::class, 'showDonationForm'])->name('campaign.donate');
Route::post('/campaign/donate', [CampaignController::class, 'processDonation'])->name('campaign.process-donation');
