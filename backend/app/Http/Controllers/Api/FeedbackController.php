<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'student_id' => 'required|integer|exists:students,id',
            'exam_id' => 'required|integer|exists:exam,id',
            'problem_types' => 'required|array',
            'feedback_text' => 'required|string',
        ]);

        $feedback = Feedback::create([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'problem_types' => $validated['problem_types'],
            'feedback_text' => $validated['feedback_text'],
        ]);

        return response()->json([
            'message' => 'Feedback submitted successfully',
            'feedback' => $feedback,
        ], 201);
    }
}