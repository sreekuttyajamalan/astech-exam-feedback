<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function show(Request $request)
    {
        $request->validate([
            'student_id' => 'required|integer|exists:students,id',
        ]);

        $student = Student::with('exams')
            ->find($request->student_id);

        return response()->json([
            'student' => [
                'id' => $student->id,
                'username' => $student->username,
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
            ],
            'exams' => $student->exams,
        ]);
    }
}