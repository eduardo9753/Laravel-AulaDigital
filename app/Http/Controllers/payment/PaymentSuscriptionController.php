<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\Pay;
use Illuminate\Http\Request;
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
                'title' => 'Académico Premium',
                'quantity' => 1,
                'unit_price' => 25
            ]
        ];

        // Se crea el código en MercadoPago
        $preference->subscription_plan_id  = '2c9380848e681dc3018e68cd27c50081';

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
            $init_point = 'https://www.mercadopago.com.pe/subscriptions/checkout?preapproval_plan_id=2c9380848e681dc3018e68cd27c50081';

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
                return redirect()->route('visitador.home.index')->with('mensaje', 'Se realizó el pago de tu suscripcion correctamente');
            } else {
                return redirect()->route('visitador.home.index')->with('mensaje', 'No se realizó el pago de tu suscripcion correctamente');
            }
        } else {
            return redirect()->route('visitador.home.index')->with('mensaje', 'No se recibió el ID de preaprobación en la solicitud');
        }
    }


    public function failure()
    {
        return "error de Suscripcion";
    }

    public function pending()
    {
        return "Suscripcion Pendiente";
    }
}
