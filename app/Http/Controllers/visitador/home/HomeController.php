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
        $courseIds = [12, 13, 14, 15];

        //$contenidos =  Resource::whereIn('resourceable_id', $courseIds)->get();

        $contenidos = Course::join('resources', 'courses.id', '=', 'resources.resourceable_id')
            ->join('images', 'courses.id', '=', 'images.imageable_id')
            ->select(
                'courses.title',
                'courses.id',
                'courses.subtitle',
                'resources.*',
                'images.url'
            )
            ->whereIn('resourceable_id', $courseIds)
            ->get();

        //para mostrarlo de forma ascendente "de las mas actualizada y que me traiga solo 8"
        $courses = Course::where('status', '=', 3)->latest('id')->take(16)->get();
        return view('visitador.home.index', [
            'courses' => $courses,
            'contenidos' => $contenidos
        ]);
    }

    public function contenido(Resource $resource)
    {
        $course = Course::find($resource->resourceable_id);
        return view('visitador.contenido.index', [
            'contenido' => $resource,
            'course' => $course
        ]);
    }
}
