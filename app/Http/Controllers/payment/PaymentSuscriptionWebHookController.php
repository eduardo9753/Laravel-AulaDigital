<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class PaymentSuscriptionWebHookController extends Controller
{
    //
    public function index(Request $request)
    {
        // Extraer los datos del payload
        $payloadArray = $request->all();
        $payloadRaw = $request->getContent();

        // Registra los datos en el log para depuración (puedes eliminar esto en producción)
        Log::info('Webhook Received (Array):', $payloadArray);
        Log::info('Webhook Received (Raw):', ['payload' => $payloadRaw]);

        // Extraer los datos necesarios del payload
        $data = $payloadArray['data'] ?? [];
        $preapprovalId = $data['id'] ?? null;

        if ($preapprovalId) {
            // Crear un nuevo registro en la base de datos
            $pay = Pay::create([
                'user_id' => auth()->user()->id, // Si el usuario está autenticado
                'collection_id' => $preapprovalId,
                'collection_status' => 'PLAN-PRE-UNI',
                'payment_id' => $preapprovalId,
                'status' => 'PAGO SUSCRIPCION',
                'external_reference' => '',
                'payment_type' => 'TARJETA',
                'merchant_order_id' => '',
                'preference_id' => $preapprovalId,
                'site_id' => 'MPE',
                'processing_mode' => 'ONLINE',
                'merchant_account_id' => $payloadArray['application_id'] ?? '',
                'estado' => 'SUSCRITO',
            ]);

            // Guardar el registro en la base de datos
            if ($pay) {
                Mail::to([auth()->user()->email, 'anthony.anec@gmail.com'])->send(new EnviarCorreoSuscripcion(auth()->user()));
                return redirect()->route('visitador.course.index')->with('mensaje', '¡El pago de tu suscripción se ha procesado correctamente! Ahora tienes acceso ilimitado a nuestros beneficios. ¡Te deseamos mucho éxito!');
            } else {
                return redirect()->route('visitador.course.index')->with('mensaje', 'Tu pago no se registró en nuestra base de datos, pero ya tienes acceso como usuario Premium.');
            }
        } else {
            // Manejar el caso en que los datos no sean válidos
            Log::error('Webhook Received: Invalid data', $payloadArray);
            return redirect()->route('mercadopago.suscription.failure');
        }
    }
}
