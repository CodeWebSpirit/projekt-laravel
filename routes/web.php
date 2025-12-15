<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\QuizController;
use App\Http\Controllers\Admin\QuizController as AdminQuizController;
use App\Http\Controllers\Admin\QuestionController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;


Route::get('/', function () {
    return view('index');
})->name('home');



Route::get('/quizzes', [QuizController::class, 'index'])
    ->name('quizzes.index');

Route::get('/quizzes/{quiz}', [QuizController::class, 'show'])
    ->name('quizzes.show');

Route::post('/quizzes/{quiz}/submit', [QuizController::class, 'submit'])
    ->name('quizzes.submit');


Route::post('/login', function(Request $request) {
    $credentials = $request->validate([
        'email' => ['required', 'email'],
        'password' => ['required'],
    ]);

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();

        if (Auth::user()->is_admin) {
            return redirect()->route('home');
        }

        Auth::logout();
        return back()->withErrors([
            'email' => 'Nie masz uprawnień administratora.',
        ]);
    }

    return back()->withErrors([
        'email' => 'Niepoprawny email lub hasło.',
    ]);
})->name('login');


Route::post('/logout', function(Request $request) {
    Auth::logout();
    $request->session()->invalidate();
    $request->session()->regenerateToken();
    return redirect()->route('home');
})->name('logout');


Route::middleware(['auth', 'admin'])
    ->prefix('admin')
    ->name('admin.')
    ->group(function () {

        

        Route::get('/quizzes', [AdminQuizController::class, 'index'])
            ->name('quizzes.index');

        Route::get('/quizzes/create', [AdminQuizController::class, 'create'])
            ->name('quizzes.create');

        Route::post('/quizzes', [AdminQuizController::class, 'store'])
            ->name('quizzes.store');

        Route::get('/quizzes/{quiz}/edit', [AdminQuizController::class, 'edit'])
            ->name('quizzes.edit');

        Route::put('/quizzes/{quiz}', [AdminQuizController::class, 'update'])
            ->name('quizzes.update');

        Route::delete('/quizzes/{quiz}', [AdminQuizController::class, 'destroy'])
            ->name('quizzes.destroy');

        Route::delete('/questions/{question}', [AdminQuizController::class, 'destroyQuestion'])
            ->name('questions.destroy');
    });
