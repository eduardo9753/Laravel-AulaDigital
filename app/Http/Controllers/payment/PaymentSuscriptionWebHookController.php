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

        // Verificar si se ha recibido el webhook con los datos esperados
        if (isset($payloadArray['data']['id'])) {
            $preapprovalId = $payloadArray['data']['id'];

            // Aquí debes buscar el usuario relacionado con el preapprovalId en tu base de datos
            $user = auth()->user()->id;

            if ($user) {
                // Crear un nuevo registro de pago
                $pay = Pay::create([
                    'user_id' => $user,
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
                    Log::info('Datos no guardados en la base de datos');
                }
            } else {
                Log::info('Usuario no encontrado para el preapproval_id: ' . $preapprovalId);
            }
        } else {
            Log::info('Datos no recibidos correctamente: ' . json_encode($payloadArray));
        }

        // Responder con HTTP 200 para indicar que el webhook fue recibido
        return response()->json(['status' => 'success'], 200);
    }
}
