<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Exam extends Model
{
    public function students(): BelongsToMany
    {
        return $this->belongsToMany(Student::class, 'exam_student');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}