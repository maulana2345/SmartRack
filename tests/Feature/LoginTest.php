<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class LoginTest extends TestCase
{
    /**
     * Test if the home page is accessible.
     */
    public function test_homepage_can_be_accessed()
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }
    public function test_login_page_redirects_to_home()
    {
        $response = $this->get('/login');
        $response->assertRedirect('/');
    }

}
