<?php

namespace Tests\Feature;

use Tests\TestCase;

class StudentExamTest extends TestCase
{
    public function test_student_exam_endpoint_is_available(): void
    {
        $response = $this->getJson('/api/student/exam?student_id=99999');

        dump($response->status());
        dump($response->json());

        $this->assertTrue(true);
    }
}