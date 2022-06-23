<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class DeleteQuizTest extends TestCase
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

    public function test_should_delete_quiz()
    {
        $this->withoutExceptionHandling();

        $this->user();

        $data = [
            'title' => 'this is a title',
            'description' => 'this is a description',
            'category' => 'general',
            'questions' => [
                [
                    'question' => 'what colour is the sky?',
                    'answer1' => 'blue',
                    'answer2' => 'red',
                    'answer3' => 'yellow',
                    'answer4' => null,
                    'correct_answer' => 'blue'
                ],
                [
                    'question' => 'what is 2 + 2?',
                    'answer1' => '4',
                    'answer2' => '2',
                    'answer3' => null,
                    'answer4' => null,
                    'correct_answer' => '4'
                ]
            ],
        ];

        $response = $this->post('/quiz/create', $data);

        $response->assertStatus(201);

        $id = 1;

        $delete_quiz = $this->delete('/quiz/delete/' . $id);
        $delete_quiz->assertStatus(204);
    }
}