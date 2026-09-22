<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Student extends Authenticatable
{
    use HasApiTokens;

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