<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\QuizController;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::middleware(['auth', 'ajax'])->group(function () {
    Route::prefix('quiz')->group(function () {
        Route::get('/', [QuizController::class, 'index'])->withoutMiddleware('ajax');
        Route::get('/show', [QuizController::class, 'show']);
        Route::post('/create', [QuizController::class, 'create']);
        Route::delete('/delete/{id}', [QuizController::class, 'delete']);
    });
});