<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class QuizIndexTest extends TestCase
{
    use RefreshDatabase;

    public function user()
    {
        //Create a user
        $user = User::factory()->create();

        //Authenticate user
        $this->actingAs($user);

        //Checking if the user is successfully logged in
        $this->assertTrue(Auth::check());

        //Returning the user
        return $user;
    }

    public function test_should_show_quiz_index_page()
    {
        $this->withoutExceptionHandling();

        $user = $this->user();

        $response = $this->get('/quiz/');

        $response->assertStatus(200);
    }
}