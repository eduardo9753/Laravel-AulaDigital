<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ExamUserAnswer extends Model
{
    use HasFactory;

    protected $fillable = [
        'exam_user_id',
        'exam_question_id',
        'answer_id',
        'puntos',
    ];


    public function examQuestion()
    {
        return $this->belongsTo(ExamQuestion::class, 'examen_question_id');
    }

    public function answer()
    {
        return $this->belongsTo(Answer::class, 'answer_id');
    }
}
