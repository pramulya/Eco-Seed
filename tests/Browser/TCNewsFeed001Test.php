<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TCNewsFeed001Test extends DuskTestCase
{

    public function testDisplaysNewsFeedList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->assertSee('What Happened Today.')
                    ->assertPresent('img'); // Ada gambar
                
        });
    }
}
