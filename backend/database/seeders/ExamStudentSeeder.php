<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\Student;
use App\Models\Exam;

class ExamStudentSeeder extends Seeder
{
    public function run(): void
    {
        $john = Student::where('username', 'john123')->first();
        $sreekutty = Student::where('username', 'sreekutty_test')->first();
        $sarah = Student::where('username', 'sarah123')->first();
        $david = Student::where('username', 'david123')->first();

        $m1 = Exam::where('name', 'M1 CAT B2 Physics')->first();
        $m9 = Exam::where('name', 'M9 CAT B1 Human Factors')->first();
        $m8 = Exam::where('name', 'M8 CAT B2 Aerodynamics')->first();
        $m3 = Exam::where('name', 'M3 CAT B1 Electrical Fund')->first();

        if (!$john || !$sreekutty || !$sarah || !$david) {
            throw new \Exception('Required students were not found.');
        }

        if (!$m1 || !$m9 || !$m8 || !$m3) {
            throw new \Exception('Required exams were not found.');
        }

        $enrollments = [
            [
                'student_id' => $john->id,
                'exam_id' => $m1->id,
            ],
            [
                'student_id' => $john->id,
                'exam_id' => $m9->id,
            ],
            [
                'student_id' => $sreekutty->id,
                'exam_id' => $m1->id,
            ],
            [
                'student_id' => $sreekutty->id,
                'exam_id' => $m8->id,
            ],
            [
                'student_id' => $sarah->id,
                'exam_id' => $m9->id,
            ],
            [
                'student_id' => $sarah->id,
                'exam_id' => $m3->id,
            ],
            [
                'student_id' => $david->id,
                'exam_id' => $m1->id,
            ],
            [
                'student_id' => $david->id,
                'exam_id' => $m3->id,
            ],
        ];

        foreach ($enrollments as $enrollment) {
            DB::table('exam_student')->updateOrInsert(
                [
                    'student_id' => $enrollment['student_id'],
                    'exam_id' => $enrollment['exam_id'],
                ],
                $enrollment
            );
        }
    }
}