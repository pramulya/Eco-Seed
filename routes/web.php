<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DonationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\Campaign\CampaignController;
use App\Livewire\DisplayCart;
use App\Livewire\Checkout;
use App\Livewire\Actions\Logout;
use App\Http\Middleware\CheckLoggedIn;
use App\Http\Controllers\SubscriptionController;
use App\Http\Controllers\PingController;
use App\Http\Controllers\VolunteerController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect('/dashboard');
    }
    return view('welcome');
});

// Donation
Route::middleware('auth')->group(function () {
    Route::get('/donate', [DonationController::class, 'showForm'])->name('donate.form');
    Route::post('/donate', [DonationController::class, 'submitDonation'])->name('donate.submit');
    Route::get('/donation-history', [DonationController::class, 'history'])->name('donation.history');
});

// Subscription
Route::middleware(['auth'])->group(function () {
    Route::get('/subscription/create', [SubscriptionController::class, 'create'])->name('subscription.create');
    Route::post('/subscription/store', [SubscriptionController::class, 'store'])->name('subscription.store');
    Route::get('/subscription/manage', [SubscriptionController::class, 'manage'])->name('subscription.manage');
    Route::post('/subscription/update', [SubscriptionController::class, 'update'])->name('subscription.update');
    Route::post('/subscription/cancel', [SubscriptionController::class, 'cancel'])->name('subscription.cancel');
});

// Dashboard
Route::middleware(CheckLoggedIn::class)->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// Cart & Checkout
Route::middleware(CheckLoggedIn::class)->group(function () {
    Route::get('/cart', DisplayCart::class)->name('cart');
    Route::get('/checkout', Checkout::class)->name('checkout');
});



// Campaigns
Route::middleware(CheckLoggedIn::class)->group(function () {
    Route::get('/campaign', [CampaignController::class, 'index'])->name('campaign.index');
    Route::get('/campaign/create', [CampaignController::class, 'create'])->name('campaign.create');
    Route::post('/campaign', [CampaignController::class, 'store'])->name('campaign.store');
    Route::get('/campaign/{campaign}/edit', [CampaignController::class, 'edit'])->name('campaign.edit');
    Route::put('/campaign/{campaign}', [CampaignController::class, 'update'])->name('campaign.update');
    Route::delete('/campaign/{campaign}', [CampaignController::class, 'destroy'])->name('campaign.destroy');
    Route::get('/campaign/{campaign}/donate', [CampaignController::class, 'showDonationForm'])->name('campaign.donate');
    Route::post('/campaign/donate', [CampaignController::class, 'processDonation'])->name('campaign.process-donation');
});

Route::middleware(CheckLoggedIn::class)->group(function () {
    Route::post('/logout', Logout::class)->name('logout');
});

use App\Http\Controllers\OrderController;

Route::middleware(['auth'])->group(function () {
    Route::get('/checkorder', [OrderController::class, 'index'])->name('checkorder');
});

Route::view('profile', 'profile')
    ->middleware(['auth'])
    ->name('profile');

require __DIR__ . '/auth.php';


Route::middleware(['auth'])->group(function () {
    Route::get('/pings', [PingController::class, 'index'])->name('pings.index');
    Route::get('/pings/create', [PingController::class, 'create'])->name('pings.create');
    Route::post('/pings', [PingController::class, 'store'])->name('pings.store');
    Route::get('/pings/{ping}/edit', [PingController::class, 'edit'])->name('pings.edit');
    Route::put('/pings/{ping}', [PingController::class, 'update'])->name('pings.update');
    Route::delete('/pings/{ping}', [PingController::class, 'destroy'])->name('pings.destroy');
    Route::resource('pings', PingController::class);
});
//articles
Route::middleware(CheckLoggedIn::class)->group(function () {
    Route::get('/articles', [ArticleController::class, 'index'])->name('articles.index');
    Route::get('/articles/create', [ArticleController::class, 'create'])->name('articles.create');
    Route::post('/articles', [ArticleController::class, 'store'])->name('articles.store');
    Route::get('/articles/confirm/{id}', [ArticleController::class, 'confirm'])->name('articles.confirm');
    Route::post('/articles/publish/{id}', [ArticleController::class, 'publish'])->name('articles.publish');
    Route::get('/articles/all', [ArticleController::class, 'all'])->name('articles.all');
    Route::get('/articles/{id}', [ArticleController::class, 'show'])->name('articles.show');
    Route::delete('/articles/{id}', [ArticleController::class, 'destroy'])->name('articles.destroy');


});


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
