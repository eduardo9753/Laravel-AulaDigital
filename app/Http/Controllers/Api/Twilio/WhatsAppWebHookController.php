<?php

namespace App\Http\Controllers\Api\Twilio;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class WhatsAppWebHookController extends Controller
{
    //

    public function handle(Request $request)
    {
       Log::info("WebHook de WhatsAppm recibido:", $request->all());
    }
}
