<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class PaymentSuscriptionWebHookController extends Controller
{
    //
    public function index(Request $request)
    {
        $payloadArray = $request->all();
        $payloadRaw = $request->getContent();

        // Registra los datos en el log para depuración (puedes eliminar esto en producción)
        Log::info('Webhook Received (Array):', $payloadArray);
        Log::info('Webhook Received (Raw):', ['payload' => $payloadRaw]);
    }
}
