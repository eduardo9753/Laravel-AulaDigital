<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;

    //HABILITAR ASIGNACION MASIVA
    protected $guarded = ['id'];

    public function commentable()
    {
        return $this->morphTo();
    }

    //UN COMENTARIO PUEDE HACER OTRO COMENTARIO
    public function comments()
    {
        return $this->morphMany('App\Models\Comment', 'commentable');
    }

    //COMENTARIOS PUEDEN TENER REACCIONES
    public function reactions()
    {
        return $this->morphMany('App\Models\Reaction', 'reactionable');
    }

    //RELACION UNO A MUCHOS INVERSA
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
