<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class TCTrendingArticle001 extends DuskTestCase
{
    public function testDisplaysTrendingArticleDetail()
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('/news')
                    ->pause(800) // tunggu render
                    ->clickLink('Nations unite to replant rainforests')
                    ->assertPathBeginsWith('/news/')
                    ->assertSee('replant rainforests')
                    ->assertSee('Story')
                    ->screenshot('trending-article');
        });
    }
}
