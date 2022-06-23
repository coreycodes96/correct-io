<?php

namespace App\Http\Actions\Quiz;

use App\Models\Quiz;

class Show
{
    public function execute()
    {
        return Quiz::with(['user' => function ($query) {
            $query->select('id', 'username');
        }])
            ->with('questions')
            ->with('questions.answers')
            ->get();
    }
}