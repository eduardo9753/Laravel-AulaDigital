<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    use HasFactory;


    protected $fillable = [
        'titulo',
        'comentario',
        'dificultad',
        'puntos',
        'estado',
        'topic_id',
        'user_id'
    ];


    public function answers()
    {
        return $this->hasMany(Answer::class, 'question_id');
    }
}
