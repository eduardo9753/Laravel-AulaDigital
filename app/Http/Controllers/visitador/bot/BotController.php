<?php

namespace App\Http\Controllers\visitador\bot;

use App\Http\Controllers\Controller;
use Smalot\PdfParser\Parser;
use Illuminate\Support\Facades\Gate;

class BotController extends Controller
{
    //
    public function index()
    {
        $user = auth()->user();
        if (Gate::allows('viewSubscriptionYear', $user)) {
            return view('visitador.bot.index');
        } else {
            // Si el usuario no tiene acceso a ninguna de las suscripciones, redirige con un mensaje de alerta
            return redirect()->route('mercadopago.suscription.subscribe');
        }
    }

    public function readBook()
    {
        $pdfPath = storage_path('app/libros/Geografa.pdf'); // Ajusta la ruta

        $parser = new Parser();
        $pdf = $parser->parseFile($pdfPath);

        $text = $pdf->getText();

        return response()->json([
            'extracto' => substr($text, 0, 500), // Solo para probar
        ]);
    }
}
