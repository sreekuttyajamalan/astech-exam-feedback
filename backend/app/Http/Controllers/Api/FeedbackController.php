<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Feedback;
use Illuminate\Http\Request;

class FeedbackController extends Controller
{
    public function store(Request $request)
    {
        // Get the authenticated student from the Sanctum token
        $student = $request->user();

        $validated = $request->validate([
            'exam_id' => 'required|integer|exists:exams,id',

            'question_number' => 'required|integer|min:1',

            'problems' => 'nullable|array',

            'specific_feedback' => 'nullable|string',

            'feedback_date' => 'required|date',
        ]);

        // Check that the authenticated student is enrolled in the exam
        if (!$student->exams()->where('exams.id', $validated['exam_id'])->exists()) {
            return response()->json([
                'message' => 'You are not enrolled in this exam.'
            ], 403);
        }

        if (
            empty($validated['problems']) &&
            empty(trim($validated['specific_feedback'] ?? ''))
        ) {
            return response()->json([
                'message' => 'Please select a problem or enter specific feedback.'
            ], 422);
        }

        $feedback = Feedback::create([
            // Student ID comes from authenticated user
            'student_id' => $student->id,

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

