<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = [
            ['id' => 1, 'title' => 'Quiz o PHP', 'description' => 'Podstawy PHP'],
            ['id' => 2, 'title' => 'Quiz o Laravel', 'description' => 'Routing, Blade, Eloquent'],
        ];

        return view('quizzes.index', compact('quizzes'));
    }

    public function show($id)
    {
        $quiz = [
            'id' => $id,
            'title' => $id == 1 ? 'Quiz o PHP' : 'Quiz o Laravel',
            'description' => 'Krótki opis quizu',
            'questions' => [
                ['id' => 1, 'text' => 'Co to jest PHP?', 'type' => 'single', 'options' => ['Język skryptowy', 'Framework', 'IDE']],
                ['id' => 2, 'text' => 'Jak uruchomić migrację?', 'type' => 'single', 'options' => ['php artisan migrate', 'npm run build', 'composer install']],
            ],
        ];

        return view('quizzes.show', compact('quiz'));
    }
}
