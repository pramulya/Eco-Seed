<?php

namespace Tests\Browser;

use App\Models\Campaign;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class EditCampaignTest extends DuskTestCase
{
    use DatabaseMigrations;

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
}