<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class LoginText extends TestCase
{
    use RefreshDatabase;

    public function test_should_login()
    {
        $data = [
            'username' => 'Johnny',
            'email' => 'johnny@test.com',
            'password' => 'password123',
        ];

        $response = $this->post('/register', [
            'username' => $data['username'],
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $response->assertStatus(200);

        $login = $this->post('/login', [
            'email' => $data['email'],
            'password' => $data['password'],
        ]);

        $login->assertStatus(200);
    }
}