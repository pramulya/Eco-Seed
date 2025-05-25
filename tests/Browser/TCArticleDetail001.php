<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TCArticleDetail001 extends DuskTestCase
{

    public function testDisplaysArticleDetailFromList()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->clickLink("Low carbon farming 'essential' for climate goals")
                    ->assertPathBeginsWith('/news/')
                    ->assertSee("The Climate Change Committee") // ringkasan isi
                    ->assertSee("A Story By admin") // penulis
                    ->assertSee("Low carbon farming"); // judul artikel
        });
    }
}
