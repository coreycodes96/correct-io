<?php

namespace App\Http\Actions\Quiz;

use App\Models\Quiz;

class Delete
{
    public function execute(int $id)
    {
        Quiz::where('id', $id)
            ->delete();

        return 'Quiz has been successfully deleted';
    }
}