<?php

namespace App\Http\Controllers\admin\pay;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PayController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('can:gestion pagos');
    }

    public function index()
    {
        return view('admin.pay.index');
    }
}
