<?php

use App\Http\Controllers\Api\Twilio\WhatsAppWebHookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


//PRUEBAS AUTOMATICAS EN TWILIO
Route::post('/webhook/whatsapp', [WhatsAppWebHookController::class, 'handle'])->name('webhook.twilio');

Route::get('/webhook/whatsapp/questions', [WhatsAppWebHookController::class, 'questions'])->name('webhook.questions');