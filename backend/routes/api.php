<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\StudentExamController;
use App\Http\Controllers\Api\FeedbackController;

Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/student/exam', [StudentExamController::class, 'show']);

    Route::post('/feedback', [FeedbackController::class, 'store']);

});
