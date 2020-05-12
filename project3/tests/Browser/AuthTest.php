<?php

namespace Tests\Browser;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Laravel\Dusk\Browser;
use Tests\DuskTestCase;

class AuthTest extends DuskTestCase
{
    /**
     * Test registering
     * @group auth
     * @return void
     */
    public function testRegistration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/e15/project3/public/register')
                    ->assertSee('Register')
                    ->type('name', 'Dolores Woolley')
                    ->type('email', 'dolores' . time() . '@gmail.com')
                    ->type('password', '123abc456')
                    ->type('password_confirmation', '123abc456')
                    ->click('button.register-btn')
                    ->assertSee('Dolores Woolley');
        });
    }

    /**
     * Test logging out
     * @group auth
     * @return void
     */
    public function testLogOut(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/e15/project3/public/')
                ->click('#navbarDropdown')
                ->click('@logout-link')
                ->assertSee('Login');
        });
    }

    /**
     * Test registering with password too short to pass validation
     * @group auth
     * @return void
     */
    public function testFailedRegistration(): void
    {
        $this->browse(function (Browser $browser) {
            $browser->visit('http://localhost/e15/project3/public/register')
                ->type('name', 'Dolores Woolley')
                ->type('email', 'dolores' . time() . '@gmail.com')
                ->type('password', '123')
                ->type('password_confirmation', '123')
                ->click('button.register-btn')
                ->assertSee('The password must be at least 8 characters.');
        });
    }
}
