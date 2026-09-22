<?php

namespace Tests\Feature;

use Tests\TestCase;

class FeedbackTest extends TestCase
{
    public function test_feedback_requires_required_fields(): void
    {
        $response = $this->postJson('/api/feedback', []);

        $response->assertStatus(422);
    }
}