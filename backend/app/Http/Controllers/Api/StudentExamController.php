<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class StudentExamController extends Controller
{
    public function show(Request $request)
    {
        // Get the authenticated student from the Sanctum token
        $student = $request->user();

        // Load only this student's registered exams
        $student->load('exams');

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
