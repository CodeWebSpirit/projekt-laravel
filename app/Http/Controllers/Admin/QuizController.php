<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Quiz;
use App\Models\Question;

class QuizController extends Controller
{

    public function index()
    {
        $quizzes = Quiz::all();
        return view('admin.quizzes.index', compact('quizzes'));
    }

    public function create()
    {
        $quiz = new Quiz();
        return view('admin.quizzes.form', compact('quiz'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'questions' => 'nullable|array',
            'questions.*.text' => 'required|string',
            'questions.*.type' => 'required|in:single,multiple',
            'questions.*.options' => 'required|json',
            'questions.*.correct_answers' => 'required|json',
        ]);

        $quiz = Quiz::create([
            'title' => $data['title'],
            'description' => $data['description'],
        ]);

        if (!empty($data['questions'])) {
            foreach ($data['questions'] as $q) {
                $quiz->questions()->create([
                    'text' => $q['text'],
                    'type' => $q['type'],
                    'options' => json_decode($q['options'], true),
                    'correct_answers' => json_decode($q['correct_answers'], true),
                ]);
            }
        }

        return redirect()->route('admin.quizzes.index');
    }


    public function edit(Quiz $quiz)
    {
        $quiz->load('questions'); 
        return view('admin.quizzes.form', compact('quiz'));
    }

    public function update(Request $request, Quiz $quiz)
{
    $data = $request->validate([
        'title' => 'required|string|max:255',
        'description' => 'required|string',
        'questions' => 'nullable|array',
        'questions.*.id' => 'nullable|integer',
        'questions.*._delete' => 'nullable|boolean',
        'questions.*.text' => 'required|string',
        'questions.*.type' => 'required|in:single,multiple',
        'questions.*.options' => 'required|json',
        'questions.*.correct_answers' => 'required|json',
    ]);

    $quiz->update([
        'title' => $data['title'],
        'description' => $data['description'],
    ]);

    if (!empty($data['questions'])) {
        foreach ($data['questions'] as $q) {

            if (!empty($q['_delete']) && !empty($q['id'])) {
                $quiz->questions()->where('id', $q['id'])->delete();
                continue;
            }

            if (!empty($q['id'])) {
                $question = $quiz->questions()->find($q['id']);
                if ($question) {
                    $question->update([
                        'text' => $q['text'],
                        'type' => $q['type'],
                        'options' => json_decode($q['options'], true),
                        'correct_answers' => json_decode($q['correct_answers'], true),
                    ]);
                }
            }
            else {
                $quiz->questions()->create([
                    'text' => $q['text'],
                    'type' => $q['type'],
                    'options' => json_decode($q['options'], true),
                    'correct_answers' => json_decode($q['correct_answers'], true),
                ]);
            }
        }
    }

    return redirect()->route('admin.quizzes.index')
        ->with('success', 'Quiz zapisany poprawnie');
}


    public function destroy(Quiz $quiz)
    {
        $quiz->delete();
        return redirect()->route('admin.quizzes.index');
    }


}
