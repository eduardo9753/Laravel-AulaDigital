<?php

namespace App\Http\Controllers\visitador\home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //INICIO DE LA PAGINA
    public function index()
    {
        //para mostrarlo de forma ascendente "de las mas actualizada y que me traiga solo 8"
        $courses = Course::where('status', '=', 3)->latest('id')->take(8)->get();
        return view('visitador.home.index', [
            'courses' => $courses
        ]);
    }
}
