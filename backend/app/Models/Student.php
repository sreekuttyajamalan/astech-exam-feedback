<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Model
{
    protected $fillable = [
        'username',
        'password',
        'firstname',
        'lastname',
    ];

    protected $hidden = [
        'password',
    ];

    public function exams(): BelongsToMany
    {
        return $this->belongsToMany(Exam::class, 'exam_student');
    }

    public function feedbacks(): HasMany
    {
        return $this->hasMany(Feedback::class);
    }
}