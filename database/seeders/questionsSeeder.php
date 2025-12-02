<?php

namespace Database\Seeders;

use App\Models\Question;
use Illuminate\Database\Seeder;

class questionsSeeder extends Seeder
{
    public function run(): void
    {
        Question::create([
            'quiz_id' => 1,
            'text' => 'Jakiego koloru jest niebo?',
            'type' => 'single',
            'options' => ['Niebieskie', 'Czerwone', 'Zielone'],
            'correct_answers' => ['Niebieskie'],
        ]);

        Question::create([
            'quiz_id' => 1,
            'text' => 'Ile nóg ma pająk?',
            'type' => 'single',
            'options' => ['6', '8', '10'],
            'correct_answers' => ['8'],
        ]);

        Question::create([
            'quiz_id' => 1,
            'text' => 'Który kraj jest największy pod względem powierzchni?',
            'type' => 'single',
            'options' => ['Chiny', 'Rosja', 'Kanada'],
            'correct_answers' => ['Rosja'],
        ]);


        Question::create([
            'quiz_id' => 2,
            'text' => 'Jaka jest największa planeta w Układzie Słonecznym?',
            'type' => 'single',
            'options' => ['Jowisz', 'Saturn', 'Ziemia'],
            'correct_answers' => ['Jowisz'],
        ]);

        Question::create([
            'quiz_id' => 2,
            'text' => 'Który język programowania jest kompilowany?',
            'type' => 'single',
            'options' => ['C++', 'JavaScript', 'PHP'],
            'correct_answers' => ['C++'],
        ]);

        Question::create([
            'quiz_id' => 2,
            'text' => 'Które z poniższych zwierząt jest ssakiem?',
            'type' => 'multiple',
            'options' => ['Krokodyl', 'Delfin', 'Orka'],
            'correct_answers' => ['Delfin', 'Orka'],
        ]);

    }
}
