<?php

namespace App\Http\Controllers\visitador\read;

use App\Http\Controllers\Controller;
use App\Models\Archive;
use App\Models\Course;
use App\Models\Resource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class ReadController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();

        // Verifica si el usuario tiene acceso a la suscripción pre-universitaria o universitaria
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user)) {
            $courses = Course::all();
            return view('visitador.read.index', [
                'courses' => $courses
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('visitador.home.index')->with('mensaje', 'Solo usuarios suscritos');
        }
    }

    public function show(Archive $archive)
    {
        $user = auth()->user();
        // Verifica si el usuario tiene acceso a la suscripción pre-universitaria o universitaria
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user)) {
            $course = Course::find($archive->course_id);

            return view('visitador.read.show', [
                'archive' => $archive,
                'course' => $course
            ]);
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('visitador.home.index')->with('mensaje', 'Solo usuarios suscritos');
        }
    }
}
