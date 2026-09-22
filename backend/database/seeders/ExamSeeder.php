<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Exam;

class ExamSeeder extends Seeder
{
    public function run(): void
    {
        Exam::updateOrCreate(
            ['name' => 'M1 CAT B2 Physics'],
            ['exam_date' => '2024-07-25']
        );

        Exam::updateOrCreate(
            ['name' => 'M9 CAT B1 Human Factors'],
            ['exam_date' => '2024-07-26']
        );

        Exam::updateOrCreate(
            ['name' => 'M8 CAT B2 Aerodynamics'],
            ['exam_date' => '2024-07-27']
        );

        Exam::updateOrCreate(
            ['name' => 'M3 CAT B1 Electrical Fund'],
            ['exam_date' => '2024-07-28']
        );
    }
}