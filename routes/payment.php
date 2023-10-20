<?php

use App\Http\Controllers\payment\PaymentController;
use Illuminate\Support\Facades\Route;


Route::get('/chekout/course/payment/{course:slug}', [PaymentController::class, 'index'])->name('checkout.course.index');
Route::post('/mercadopago/payment', [PaymentController::class, 'pay'])->name('mercadopago.checkout');
Route::get('/mercadopago/success/{course}', [PaymentController::class, 'success'])->name('mercadopago.success');
Route::get('/mercadopago/failure', [PaymentController::class, 'failure'])->name('mercadopago.failure');
Route::get('/mercadopago/pending', [PaymentController::class, 'pending'])->name('mercadopago.pending');
