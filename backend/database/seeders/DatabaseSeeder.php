<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Student;
use App\Models\Exam;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call([
            StudentSeeder::class,
            ExamSeeder::class,
        ]);

        $student1 = Student::where('username', 'john123')->first();
        $student2 = Student::where('username', 'sarah123')->first();
        $student3 = Student::where('username', 'david123')->first();

        $exam1 = Exam::where('name', 'Laravel Fundamentals')->first();
        $exam2 = Exam::where('name', 'PHP Programming')->first();
        $exam3 = Exam::where('name', 'Database Fundamentals')->first();

        $student1->exams()->attach([
            $exam1->id,
            $exam2->id,
        ]);

        $student2->exams()->attach([
            $exam1->id,
            $exam3->id,
        ]);

        $student3->exams()->attach([
            $exam2->id,
            $exam3->id,
        ]);
    }
}
