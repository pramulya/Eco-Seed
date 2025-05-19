<?php

namespace Tests\Browser;

use App\Models\Campaign;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CampaignTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function testSuccessfulCampaignCreation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/campaign/create')
                    ->type('campaign_name', 'New Test Campaign')
                    ->select('campaign_type', 'Tree Planting')
                    ->select('campaign_category', 'Environmental')
                    ->type('campaign_organizer', 'Test Organization')
                    ->type('campaign_target', '10000')
                    ->type('campaign_start_date', '2024-03-01')
                    ->type('campaign_end_date', '2024-12-31')
                    ->type('campaign_description', 'Detailed test description')
                    ->press('Create Campaign')
                    ->assertPathIs('/campaign')
                    ->assertSee('Campaign created successfully!')
                    ->assertSee('New Test Campaign');
        });
    }

    public function testCampaignCreationValidation()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/campaign/create')
                    ->press('Create Campaign')
                    ->assertSee('The campaign name field is required')
                    ->type('campaign_target', '-100')
                    ->press('Create Campaign')
                    ->assertSee('The campaign target must be at least 0');
        });
    }

    public function testSuccessfulCampaignEdit()
    {
        $campaign = Campaign::create([
            'campaign_name' => 'Original Campaign Name',
            'campaign_type' => 'Tree Planting',
            'campaign_category' => 'Environmental',
            'campaign_organizer' => 'Original Org',
            'campaign_target' => 5000,
            'campaign_start_date' => '2024-03-01',
            'campaign_end_date' => '2024-12-31',
            'campaign_description' => 'Original description'
        ]);

        $this->browse(function (Browser $browser) use ($campaign) {
            $browser->visit("/campaign/{$campaign->id}/edit")
                    ->assertSee('Original Campaign Name')
                    ->type('campaign_name', 'Updated Campaign Name')
                    ->type('campaign_target', '7500')
                    ->type('campaign_description', 'Updated description')
                    ->press('Update Campaign')
                    ->assertPathIs('/campaign')
                    ->assertSee('Campaign updated successfully!')
                    ->assertSee('Updated Campaign Name');
        });
    }

    public function testCampaignEditValidation()
    {
        $campaign = Campaign::create([
            'campaign_name' => 'Test Campaign',
            'campaign_type' => 'Tree Planting',
            'campaign_category' => 'Environmental',
            'campaign_organizer' => 'Test Org',
            'campaign_target' => 1000,
            'campaign_start_date' => '2024-03-01',
            'campaign_end_date' => '2024-12-31',
            'campaign_description' => 'Test description'
        ]);

        $this->browse(function (Browser $browser) use ($campaign) {
            $browser->visit("/campaign/{$campaign->id}/edit")
                    ->type('campaign_name', '')
                    ->press('Update Campaign')
                    ->assertSee('The campaign name field is required');
        });
    }

    public function testSuccessfulCampaignDeletion()
    {
        $campaign = Campaign::create([
            'campaign_name' => 'Campaign To Delete',
            'campaign_type' => 'Conservation',
            'campaign_category' => 'Environmental',
            'campaign_organizer' => 'Test Org',
            'campaign_target' => 1000,
            'campaign_start_date' => '2024-03-01',
            'campaign_end_date' => '2024-12-31',
            'campaign_description' => 'Test description'
        ]);

        $this->browse(function (Browser $browser) use ($campaign) {
            $browser->visit('/campaign')
                    ->assertSee('Campaign To Delete')
                    ->press('Delete')
                    ->acceptDialog()
                    ->assertPathIs('/campaign')
                    ->assertSee('Campaign deleted successfully!')
                    ->assertDontSee('Campaign To Delete');
        });
    }

    public function testCampaignDeleteConfirmation()
    {
        $campaign = Campaign::create([
            'campaign_name' => 'Test Campaign',
            'campaign_type' => 'Conservation',
            'campaign_category' => 'Environmental',
            'campaign_organizer' => 'Test Org',
            'campaign_target' => 1000,
            'campaign_start_date' => '2024-03-01',
            'campaign_end_date' => '2024-12-31',
            'campaign_description' => 'Test description'
        ]);

        $this->browse(function (Browser $browser) use ($campaign) {
            $browser->visit('/campaign')
                    ->assertSee('Test Campaign')
                    ->press('Delete')
                    ->dismissDialog()
                    ->assertSee('Test Campaign');
        });
    }

    public function testNotificationDisplay()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/campaign/create')
                    ->type('campaign_name', 'Notification Test Campaign')
                    ->select('campaign_type', 'Tree Planting')
                    ->select('campaign_category', 'Environmental')
                    ->type('campaign_organizer', 'Test Org')
                    ->type('campaign_target', '1000')
                    ->type('campaign_start_date', '2024-03-01')
                    ->type('campaign_end_date', '2024-12-31')
                    ->type('campaign_description', 'Test description')
                    ->press('Create Campaign')
                    ->assertSee('Campaign created successfully!')
                    ->assertPresent('.alert-success');
        });
    }
}
