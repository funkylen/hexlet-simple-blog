<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    public function testAuthPage(): void
    {
        $response = $this->get(route('auth_page'));

        $response->assertOk();
    }

    public function testAuth(): void
    {
        $body = [
            'login' => 'admin',
            'password' => 'password',
        ];

        $response = $this->post(route('auth'), $body);

        $response->assertRedirect();

        $response->assertSessionHas('auth');
    }
}
