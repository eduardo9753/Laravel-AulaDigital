<?php

use App\Http\Controllers\payment\PaymentController;
use App\Http\Controllers\payment\PaymentSuscriptionController;
use Illuminate\Support\Facades\Route;


//RUTAS PARA PAGAR UN CURSO CON MERCADOPAGO
Route::get('/chekout/course/payment/{course:slug}', [PaymentController::class, 'index'])->name('checkout.course.index');
Route::post('/mercadopago/payment', [PaymentController::class, 'pay'])->name('mercadopago.checkout');
Route::get('/mercadopago/success/{course}', [PaymentController::class, 'success'])->name('mercadopago.success');
Route::get('/mercadopago/failure', [PaymentController::class, 'failure'])->name('mercadopago.failure');
Route::get('/mercadopago/pending', [PaymentController::class, 'pending'])->name('mercadopago.pending');



//RUTAS PARA SUSCRIPTION CON MERCADOPAGO
Route::post('/mercadopago/suscription/academico-premium', [PaymentSuscriptionController::class, 'suscription'])->name('mercadopago.suscription.index');
Route::get('/mercadopago/suscription/academico-premium/success', [PaymentSuscriptionController::class, 'success'])->name('mercadopago.suscription.success');
Route::get('/mercadopago/suscription/academico-premium/failure', [PaymentSuscriptionController::class, 'failure'])->name('mercadopago.suscription.failure');
Route::get('/mercadopago/suscription/academico-premium/pending', [PaymentSuscriptionController::class, 'pending'])->name('mercadopago.suscription.pending');


Route::post('/yape/payment/{course}', [PaymentController::class, 'yape'])->name('yape.index');
