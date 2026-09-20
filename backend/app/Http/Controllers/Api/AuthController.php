<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required|string',
            'password' => 'required|string',
        ]);

        $student = Student::where(
            'username',
            $request->username
        )->first();

        if (!$student) {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401);
        }

        if (!Hash::check($request->password, $student->password)) {
            return response()->json([
                'message' => 'Invalid username or password'
            ], 401);
        }

        return response()->json([
            'message' => 'Login successful',
            'student' => [
                'id' => $student->id,
                'username' => $student->username,
                'firstname' => $student->firstname,
                'lastname' => $student->lastname,
            ]
        ]);
    }
}