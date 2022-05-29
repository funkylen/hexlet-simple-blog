<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DashboardTest extends TestCase
{
    public function testSimpleAuthMiddlewareOk(): void
    {
        $this->session([
            'auth' => true,
        ]);

        $response = $this->get(route('dashboard'));

        $response->assertOk();
    }

    public function testSimpleAuthMiddlewareUnauthorized(): void
    {
        $response = $this->get(route('dashboard'));

        $response->assertUnauthorized();
    }
}
