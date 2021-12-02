<?php

namespace Tests\Feature;


use Tests\TestCase;

class HomeTest extends TestCase
{
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function testHomePage()
    {
        $response = $this->get('/home');

        //$response->assertStatus(200);
        $response->assertSeeText('Home page');
        $response->assertSeeText('Learn Laravel 8.73.2');

    }


    public function testAboutPage()  {

        $response = $this->get('/about');
        $response->assertSeeText('Hi this is Aicha');
    }
}
