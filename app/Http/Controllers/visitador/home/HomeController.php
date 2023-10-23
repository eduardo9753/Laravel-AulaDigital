<?php

namespace App\Http\Controllers\visitador\home;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    //INICIO DE LA PAGINA
    public function index()
    {

        //PARA EL CONTENIDO
        $resourceIds = Resource::whereIn('resourceable_id', [12, 13, 14, 15])->pluck('id');

        $contenidos = Course::join('resources', 'courses.id', '=', 'resources.resourceable_id')
            ->select('courses.title', 'resources.url')
            ->whereIn('courses.id', $resourceIds)
            ->get();

        //para mostrarlo de forma ascendente "de las mas actualizada y que me traiga solo 8"
        $courses = Course::where('status', '=', 3)->latest('id')->take(8)->get();
        return view('visitador.home.index', [
            'courses' => $courses,
            'contenidos' => $contenidos
        ]);
    }

    public function contenido(Course $course)
    {
        $contenido = Resource::find($course->id);
        return view('visitador.contenido.index',[
            'contenido' => $contenido,
            'course' => $course
        ]);
    }
}
