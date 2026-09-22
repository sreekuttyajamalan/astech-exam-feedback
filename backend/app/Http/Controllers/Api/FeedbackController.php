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

            'exam_id' => 'required|integer|exists:exams,id',

            'question_number' => 'required|integer|min:1',

            'problems' => 'nullable|array',

            'specific_feedback' => 'nullable|string',

            'feedback_date' => 'required|date',
        ]);

        if (
            empty($validated['problems']) &&
            empty(trim($validated['specific_feedback'] ?? ''))
        ) {
            return response()->json([
                'message' => 'Please select a problem or enter specific feedback.'
            ], 422);
        }

        $feedback = Feedback::create([
            'student_id' => $validated['student_id'],
            'exam_id' => $validated['exam_id'],
            'question_number' => $validated['question_number'],
            'problems' => $validated['problems'] ?? [],
            'specific_feedback' => $validated['specific_feedback'] ?? null,
            'feedback_date' => $validated['feedback_date'],
        ]);

        return response()->json([
            'message' => 'Feedback submitted successfully.',
            'feedback' => $feedback,
        ], 201);
    }
}