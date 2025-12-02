<?php

namespace App\Http\Controllers;

use App\Models\Quiz;
use Illuminate\Http\Request;

class QuizController extends Controller
{
    public function index()
    {
        $quizzes = Quiz::all();
        return view('quizzes.index', compact('quizzes'));
    }
    public function show(Quiz $quiz)
    {
        $quiz->load('questions');
        return view('quizzes.show', compact('quiz'));
    }

    public function submit(Request $request, Quiz $quiz)
{
    $rules = [];

    foreach ($quiz->questions as $question) {
        if ($question->type === 'multiple') {
            $rules['answers.' . $question->id] = 'required|array';
        } else { 
            $rules['answers.' . $question->id] = 'required|string';
        }
    }

    $validated = $request->validate($rules);

    $score = 0;
    foreach ($quiz->questions as $question) {
        $userAnswers = $validated['answers'][$question->id];

        if ($question->type === 'single') {
            $userAnswers = [$userAnswers];
        }

        if (array_diff($question->correct_answers, $userAnswers) === array_diff($userAnswers, $question->correct_answers)) {
            $score++;
        }
    }

    return view('quizzes.result', compact('quiz', 'score'));
}

}
