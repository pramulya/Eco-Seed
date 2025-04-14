<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Livewire\DisplayCart;

Route::get('/', function () {
  return view('welcome');
});

Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/cart', DisplayCart::class);
Route::get('/campaigns', [CampaignController::class, 'index']);
Route::get('/campaigns/{id}', [CampaignController::class, 'show']);

Route::post('/campaigns/volunteer', [CampaignController::class, 'joinVolunteer'])->name('campaigns.volunteer');
Route::post('/campaigns/donate', [CampaignController::class, 'donate'])->name('campaigns.donate');
