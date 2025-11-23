<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;

// Route::get('/', function () {
//     return view('welcome');
// });


Route::get('/', function () {
    return view('index');
})->name('home');

Route::get('/quizzes', [QuizController::class, 'index'])->name('quizzes.index');
Route::get('/quizzes/{id}', [QuizController::class, 'show'])->name('quizzes.show');
