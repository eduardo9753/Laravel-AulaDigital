<?php

namespace App\Http\Controllers\admin\compendium;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CompendiumController extends Controller
{
    //
    public function __construct()
    {
        $this->middleware('auth');
    }

    //crud livewire
    public function index()
    {
        return view('admin.compendium.index');
    }
}
