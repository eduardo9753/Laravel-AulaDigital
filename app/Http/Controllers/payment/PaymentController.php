<?php

namespace App\Http\Controllers\payment;

use App\Http\Controllers\Controller;
use App\Models\Course;
use App\Models\Pay;
use Illuminate\Http\Request;
use MercadoPago\SDK;
use MercadoPago\Preference;
use MercadoPago\Item;



class PaymentController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(Course $course)
    {
        //return $course;
        return view('payment.index', [
            'course' => $course
        ]);
    }

    public function pay(Request $request)
    {
        $course = Course::find($request->course_id);

        // Agrega credenciales
        SDK::setAccessToken(config('mercadopago.token'));
        $public_key = config('mercadopago.public_key');
        $preference = new Preference();
        $curso = [];

        // Crea un ítem en la preferencia
        $count = 1;
        while ($count <= 1) {
            $item = new Item();
            $item->title = $course->title;
            $item->description = $course->subtitle;
            $item->quantity = $count;
            $item->unit_price = $course->price->value;
            $count = $count + 1;

            $curso[] = $item;
        }

        //dd($curso);
        $preference->items = $curso;

        $preference->back_urls = [
            'success' => route('mercadopago.success', $course),
            'failure' => route('mercadopago.failure'),
            'pending' => route('mercadopago.pending'),
        ];
        $preference->auto_return = 'approved'; // Redirige automáticamente al usuario después de un pago aprobado


        // Guarda la preferencia
        $save = $preference->save();

        // Obtiene el link de pago
        $paymentLink = $preference->init_point;

        //dd($paymentLink);

        if ($save) {
            $dato = [
                'public_key' => $public_key,
                'preference_id' =>  $preference->id,
                'url' => $preference->back_urls,
                'init_point' => $paymentLink
            ];
            return response()->json([
                'code' => 1,
                'msg' => $dato
            ]);
        } else {
            return response()->json([
                'code' => 0,
                'msg' => 'Error de Datos'
            ]);
        }
    }

    public function success(Request $request, Course $course)
    {
        //return $course;
        //puedes registrarlo en la base de datos
        if ($request->status === 'approved') {
            $pay = Pay::create([
                'user_id' => auth()->user()->id,
                'collection_id' => $request->collection_id,
                'collection_status' => $request->collection_status,
                'payment_id' => $request->payment_id,
                'status' => $request->status,
                'external_reference' => $request->external_reference,
                'payment_type' => $request->payment_type,
                'merchant_order_id' => $request->merchant_order_id,
                'preference_id' => $request->preference_id,
                'site_id' => $request->site_id,
                'processing_mode' => $request->processing_mode,
                'merchant_account_id' => $request->merchant_account_id,
                'estado' => 'ACTIVO',
            ]);

            if ($pay) {
                //CADA VEZ QUE EL USUARIO LE DE CLICK EN "llevar curso" 
                //SE GUARDARA ESOS DATOS EN LA TABLA "course_user"
                $course->students()->attach(auth()->user()->id);

                return redirect()->route('visitador.course.status', $course);
            }
        }
        //else para las demos estados 
    }

    public function failure()
    {
        return "error de pago";
    }

    public function pending()
    {
        return "Pago Pendiente";
    }
}
