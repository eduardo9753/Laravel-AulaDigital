<?php

namespace App\Http\Controllers\visitador\post;

use App\Http\Controllers\Controller;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class PostController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscription', $user) || Gate::allows('viewSubscriptionUniversitario', $user) || Gate::allows('viewSubscriptionEscolar', $user)) {
            return view('visitador.post.index');
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }
}
