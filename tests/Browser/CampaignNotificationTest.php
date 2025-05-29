<?php

namespace Tests\Browser;

use Laravel\Dusk\Browser;
use Tests\DuskTestCase;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class CampaignNotificationTest extends DuskTestCase
{
    use DatabaseMigrations;

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