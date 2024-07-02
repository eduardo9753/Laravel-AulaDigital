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
        // Obtener el payload del webhook en formato JSON
        $payloadRaw = $request->getContent();

        // Decodificar el JSON del payload
        $payloadArray = json_decode($payloadRaw, true);

        // Registra los datos en el log para depuración (puedes eliminar esto en producción)
        Log::info('Webhook Received (Array):', $payloadArray);

        // Verificar si se ha recibido el webhook con los datos esperados
        if (isset($payloadArray['data']['id'])) {
            $preapprovalId = $payloadArray['data']['id'];

            // Verificar si el usuario está autenticado
            if (auth()->check()) {
                $user = auth()->user();

                // Crear un nuevo registro de pago
                $pay = Pay::create([
                    'user_id' => $user->id,
                    'collection_id' => '',
                    'collection_status' => 'PLAN-PRE-UNI',
                    'payment_id' => $preapprovalId,
                    'status' => 'PAGO SUSCRIPCION',
                    'external_reference' => '',
                    'payment_type' => 'TARJETA',
                    'merchant_order_id' => '',
                    'preference_id' => $preapprovalId,
                    'site_id' => 'MPE',
                    'processing_mode' => 'ONLINE',
                    'merchant_account_id' => '',
                    'estado' => 'SUSCRITO',
                ]);

                // Enviar correo de confirmación
                if ($pay) {
                    Mail::to([$user->email, 'anthony.anec@gmail.com'])->send(new EnviarCorreoSuscripcion($user));
                    Log::info('Suscripcion guardada en la bd correctamente');
                } else {
                    Log::error('Error al guardar la suscripción en la base de datos');
                }
            } else {
                Log::error('Usuario no autenticado para guardar la suscripción');
            }
        } else {
            Log::error('Datos incompletos o incorrectos recibidos del webhook: ' . $payloadRaw);
        }

        // Responder con HTTP 200 para indicar que el webhook fue recibido y procesado correctamente
        return response()->json(['status' => 'success'], 200);
    }
}
