<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Exam::create([
            'name' => 'Laravel Fundamentals',
        ]);

        Exam::create([
            'name' => 'PHP Programming',
        ]);

        Exam::create([
            'name' => 'Database Fundamentals',
        ]);
    }
}