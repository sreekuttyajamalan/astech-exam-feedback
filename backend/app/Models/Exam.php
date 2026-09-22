<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $table = 'exams';

    protected $fillable = [
        'name',
        'exam_date',
    ];

    protected $casts = [
        'exam_date' => 'date',
    ];

    public function students()
    {
        return $this->belongsToMany(
            Student::class,
            'exam_student',
            'exam_id',
            'student_id'
        );
    }
}