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
        $student = Student::first();

        $exam = Exam::where(
            'name',
            'M1 CAT B2 Physics'
        )->first();

        if (!$student) {
            throw new \Exception(
                'No student was created by StudentSeeder.'
            );
        }

        if (!$exam) {
            throw new \Exception(
                'M1 CAT B2 Physics exam was not found.'
            );
        }

        DB::table('exam_student')->insert([
            'student_id' => $student->id,
            'exam_id' => $exam->id,
        ]);
    }
}