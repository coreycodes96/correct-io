<?php

namespace App\Http\Actions\Quiz;

use App\Models\Quiz;
use App\Models\Question;
use App\Models\Answer;
use Illuminate\Http\Request;

class Create
{
    public function execute(Request $request)
    {
        //Enter to quiz db
        $quiz = Quiz::create([
            'user_id' => auth()->user()->id,
            'title' => $request['title'],
            'description' => $request['description'],
            'category' => $request['category']
        ]);

        foreach ($request['questions'] as $question) {
            //Enter to question database
            $newQuestion = Question::create([
                'quiz_id' => $quiz->id,
                'question' => $question['question']
            ]);

            Answer::create([
                'question_id' => $newQuestion->id,
                'answer1' => $question['answer1'],
                'answer2' => $question['answer2'],
                'answer3' => $question['answer3'] ? $question['answer3'] : null,
                'answer4' => $question['answer4'] ? $question['answer4'] : null,
                'correct_answer' => $question['correct_answer']
            ]);
        }

        return 'Quiz has been successfully created';
    }
}