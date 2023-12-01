<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    const ACTIVO = 'activo';
    const PENDIENTE = 'pendiente';
    const INACTIVO = 'inactivo';


    protected $fillable = [
        'nombre',
        'slug',
        'duracion',
        'estado',
        'publicacion',
        'user_id',
    ];

}
