<?php

namespace App\Http\Controllers\visitador\bot;

use App\Http\Controllers\Controller;
use Smalot\PdfParser\Parser;
use Illuminate\Http\Request;

class BotController extends Controller
{
    //
    public function index()
    {
        return view('visitador.bot.index');
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
