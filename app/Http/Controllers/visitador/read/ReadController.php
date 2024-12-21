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
        try {
            $user = auth()->user();

            if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user)) {
                $courses = Course::with(['archives' => function ($query) {
                    $query->where('type', '<>', 'C')
                        ->orWhereNull('type');
                }])->get();

                return view('visitador.read.index', [
                    'courses' => $courses
                ]);
            } else {
                // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
                return redirect()->route('mercadopago.suscription.subscribe');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }

    public function show(Archive $archive)
    {
        try {
            $user = auth()->user();

            if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user)) {
                $course = Course::find($archive->course_id);

                return view('visitador.read.show', [
                    'archive' => $archive,
                    'course' => $course
                ]);
            } else {
                // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
                return redirect()->route('mercadopago.suscription.subscribe');
            }
        } catch (\Throwable $th) {
            //throw $th;
        }
    }
}
