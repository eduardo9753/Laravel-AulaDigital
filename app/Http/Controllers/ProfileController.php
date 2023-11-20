<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class ProfileController extends Controller
{
    //
    public function index(User $user)
    {
        //return $user;
        return view('visitador.profile.index', [
            'user' => $user
        ]);
    }
}
