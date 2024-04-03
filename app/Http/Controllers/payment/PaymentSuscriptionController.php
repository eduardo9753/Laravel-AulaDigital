<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Mail\EnviarCorreoSuscripcion;
use App\Models\Pay;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use MercadoPago\SDK;
use MercadoPago\Preference;

class PaymentSuscriptionController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }


    //pago de suscripcion recurrente
    public function suscription()
    {
        // Configura las credenciales de Mercado Pago
        SDK::setAccessToken(config('mercadopago.token'));

        // Creando el objeto de preferencia de suscripción
        $preference = new Preference();

        // Configuración de los detalles de la suscripción
        $preference->items = [
            [
                'title' => 'PreuniCursos - Plan Pre Universitario',
                'quantity' => 1,
                'unit_price' => 35
            ]
        ];

        // Se crea el código en MercadoPago
        $preference->subscription_plan_id  = '2c9380848e681d84018e7821538c0912';

        // URL de retorno del estado del pago
        $preference->back_urls = [
            'success' => route('mercadopago.suscription.success'),
            'failure' => route('mercadopago.suscription.failure'),
            'pending' => route('mercadopago.suscription.pending'),
        ];

        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado

        // Guardamos la preferencia
        $save = $preference->save();

        // Redirige al usuario al checkout de Mercado Pago para la suscripción
        if ($save) {
            $init_point = 'https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848e681d84018e7821538c0912';

            return response()->json([
                'code' => 1,
                'msg' => $init_point
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'No se Guardo la preferencia correctamente'
            ]);
        }
    }

    public function success(Request $request)
    {
        if (isset($request->preapproval_id)) {
            $pay = Pay::create([
                'user_id' => auth()->user()->id,
                'collection_id' => '',
                'collection_status' => 'PLAN-PRE-UNI',
                'payment_id' => $request->preapproval_id,
                'status' => 'PAGO SUSCRIPCION',
                'external_reference' => '',
                'payment_type' => 'TARJETA',
                'merchant_order_id' => '',
                'preference_id' => $request->preapproval_id,
                'site_id' => 'MPE',
                'processing_mode' => 'ONLINE',
                'merchant_account_id' => '',
                'estado' => 'SUSCRITO',
            ]);

            if ($pay) {
                Mail::to([auth()->user()->email, 'anthony.anec@gmail.com'])->send(new EnviarCorreoSuscripcion(auth()->user()));
                return redirect()->route('visitador.course.index')->with('mensaje', '¡El pago de tu suscripción se ha procesado correctamente! Ahora tienes acceso ilimitado a nuestros beneficios. ¡Te deseamos mucho éxito!');
            } else {
                return redirect()->route('visitador.course.index')->with('mensaje', 'Tu pago no se registró en nuestra base de datos, pero ya tienes acceso como usuario Premium.');
            }
        } else {
            return redirect()->route('mercadopago.suscription.failure');
        }
    }


    public function failure()
    {
        return view('payment.failure');
    }

    public function pending()
    {
        return view('payment.pending');
    }

    public function subscribe()
    {
        return view('payment.suscribete');
    }
}
