<?php

namespace App\Http\Controllers\visitador\bot;

use App\Http\Controllers\Controller;

use Illuminate\Http\Request;

class BotController extends Controller
{
    //
    public function index()
    {
        return view('visitador.bot.index');
    }
}
