<?php

namespace Tests\Feature;

use Tests\TestCase;

class AuthTest extends TestCase
{
    public function test_login_endpoint_is_available(): void
    {
        $response = $this->postJson('/api/login', []);

        $response->assertStatus(422);
    }
}