<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class RouterTest extends TestCase
{
   
    /** @test **/
    public function welcome_page()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

     /** @test **/
    public function home_page()
    {
        $response = $this->get('/home');

        $response->assertStatus(302);
    }

}
