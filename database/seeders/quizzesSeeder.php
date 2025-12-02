<?php

namespace Database\Seeders;

use App\Models\Quiz;
use Illuminate\Database\Seeder;

class quizzesSeeder extends Seeder
{
    public function run(): void
    {
        Quiz::create([
            'title' => 'Quiz o czymś',
            'description' => 'Pytania dotyczące różnych tematów.'
        ]);

        Quiz::create([
            'title' => 'Quiz o czymś innym',
            'description' => 'Pytania dotyczące innych tematów.'
        ]);
    }
}
