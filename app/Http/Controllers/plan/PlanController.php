<?php

namespace App\Http\Controllers\plan;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use App\Models\User;
use Illuminate\Http\Request;

class PlanController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(User $user)
    {
        $suscription = Pay::where('estado', 'SUSCRITO')->first();

        if (!$suscription) {
            return redirect()->route('mercadopago.suscription.subscribe');
        } else {
            return view('visitador.plan.index', [
                'user' => $user,
                'suscription' => $suscription
            ]);
        }
    }
}
