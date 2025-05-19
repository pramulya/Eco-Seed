<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CreateCampaignTest extends DuskTestCase
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
}