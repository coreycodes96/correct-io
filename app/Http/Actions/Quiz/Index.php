<?php

namespace App\Http\Actions\Quiz;

class Index
{
    public function execute()
    {
        return view('layouts.Quiz.quiz');
    }
}