<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CreateAccountTest extends TestCase
{
    use RefreshDatabase;

    public function test_should_create_an_account()
    {
        $response = $this->post('/register', [
            'username' => 'Johnny',
            'email' => 'johnny@test.com',
            'password' => 'password123',
        ]);

        $response->assertStatus(200);
    }
}