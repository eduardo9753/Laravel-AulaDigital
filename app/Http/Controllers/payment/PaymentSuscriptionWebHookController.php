<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use MercadoPago\Preapproval;
use MercadoPago\SDK;

class PaymentSuscriptionWebHookController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el payload del webhook en formato JSON
        $payloadRaw = $request->getContent();
        $payloadArray = json_decode($payloadRaw, true);

        Log::info('Webhook Received:', $payloadArray);

        // Validar la estructura del webhook
        if (!isset($payloadArray['data']['id']) || !isset($payloadArray['type'])) {
            Log::error('Datos incompletos o incorrectos recibidos del webhook: ' . $payloadRaw);
            return response()->json(['status' => 'error', 'message' => 'Invalid payload'], 400);
        }

        $preapprovalId = $payloadArray['data']['id'];
        $eventType = $payloadArray['type'];

        // Configura las credenciales de Mercado Pago
        SDK::setAccessToken(config('mercadopago.token'));

        // Consultar el estado de la suscripción desde la API de Mercado Pago
        $paymentInfo = $this->obtenerDetallePago($preapprovalId);

        // Consultar si existe el ID del pago en mi tabla
        $payUser = $this->payUsuario($preapprovalId);

        if (!$paymentInfo || !isset($paymentInfo->status)) {
            Log::error('No se pudo obtener información del pago.');
            return response()->json(['status' => 'error', 'message' => 'Payment information not found'], 404);
        }

        if ($paymentInfo->status === 'authorized') {
            // Registro de primer pago o actualización de pago recurrente
            $pay = Pay::updateOrCreate(
                ['payment_id' => $preapprovalId],
                [
                    'user_id' => $payUser->user_id ?? '1', // Puedes ajustar el valor predeterminado
                    'collection_id' => $paymentInfo->id ?? '',
                    'collection_status' => $payUser->collection_status ?? '',
                    'status' => 'PAGO SUSCRIPCION',
                    'external_reference' => $paymentInfo->external_reference ?? '',
                    'payment_type' => 'TARJETA',
                    'merchant_order_id' => $paymentInfo->order->id ?? '',
                    'preference_id' => $preapprovalId,
                    'site_id' => 'MPE',
                    'processing_mode' => 'ONLINE',
                    'merchant_account_id' => $paymentInfo->merchant_account_id ?? '',
                    'estado' => 'POR ATENDER',
                ]
            );

            if ($pay) {
                Log::info('Pago recurrente registrado o actualizado correctamente.');
            } else {
                Log::error('Error al registrar el pago recurrente en la base de datos.');
            }
        } elseif ($paymentInfo->status === 'rejected' || $paymentInfo->status === 'cancelled') {
            // Actualizar estado si el pago fue rechazado o cancelado
            $suscripcion = Pay::where('payment_id', $preapprovalId)->first();

            if ($suscripcion) {
                $suscripcion->update(['estado' => 'CANCELADO']);
                Log::info('Suscripción actualizada a inactivo debido a pago fallido o cancelado.');
            }
        } else {
            Log::error('No se encontro el estado solicitado.');
        }

        return response()->json(['status' => 'success'], 200);
    }

    // Función para consultar el estado del pago de la suscripción
    private function obtenerDetallePago($preapprovalId)
    {
        try {
            return Preapproval::find_by_id($preapprovalId);
        } catch (\Throwable $th) {
            Log::error("Error al obtener los detalles del pago: " . $th->getMessage());
            return null;
        }
    }

    // Obtener el usuario por medio del pago
    private function payUsuario($preapprovalId)
    {
        return Pay::where('payment_id', $preapprovalId)->first();
    }
}
