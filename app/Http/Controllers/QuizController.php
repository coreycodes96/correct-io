<?php

namespace App\Http\Controllers;

use App\Http\Actions\Quiz\Index;
use App\Http\Actions\Quiz\Show;
use App\Http\Actions\Quiz\Create;
use App\Http\Actions\Quiz\Delete;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index(Index $action)
    {
        return $action->execute();
    }

    public function show(Show $action)
    {
        return response()->json($action->execute(), 200);
    }

    public function create(Request $request, Create $action)
    {
        return response()->json($action->execute($request), 201);
    }

    public function delete(int $id, Delete $action)
    {
        return response()->json($action->execute($id), 204);
    }
}