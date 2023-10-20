<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasRoles;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    //HABILITAR ASIGNACION MASIVA
    protected $fillable = [
        'name',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    //RELACION UNO A UNO ""
    public function profile()
    {
        return $this->hasOne('App\Models\Profile');
    }

    //RELACION UNO A MUCHOS PROFESOR TIENE MUCHOS CURSOS "me retorna los cursos dictados del profesor"
    public function courses_dictated()
    {
        return $this->hasMany('App\Models\Course');
    }

    //RELACION MUCHOS A MUCHOS ALUMNO TIENE MUCHOS CURSOS "me retorna los cursos que esta matriculado el alumno"
    public function courses_enrolled()
    {
        return $this->belongsToMany('App\Models\Course');
    }

    //RELACION UNA A MUCHOS USUARIO PUEDE HACER MUCHO REVIEWS"me retorna los reviews de los alumnos que dejaron en los cursos"
    public function reviews()
    {
        return $this->hasMany('App\Models\Review');
    }

    //RELACION MUCHOS A MUCHOS
    public function lessons()
    {
        return $this->belongsToMany('App\Models\Leson');
    }

    //RELACION UNO A MUCHOS
    public function comments()
    {
        return $this->hasMany('App\Models\Comment');
    }

    //RELACION UNO A MUCHOS
    public function reactions()
    {
        return $this->hasMany('App\Models\Reaction');
    }
}
