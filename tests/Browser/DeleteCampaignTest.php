<?php

namespace Tests\Browser;

use App\Models\Campaign;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class DeleteCampaignTest extends DuskTestCase
{
    use DatabaseMigrations;

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
}