<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Mail\MailUserBienvenida;
use App\Mail\MailUserRecover;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;

class RegisterController extends Controller
{
    ///register
    public function index()
    {
        return view('admin.auth.register');
    }

    //guardar registro
    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'name' => 'required|min:3|max:30',
            'email' => 'required|unique:users|email|max:70',
            'password' => 'required|confirmed|min:6|max:30'
        ]);

        //creamos al usuario
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'imagen' => '',
            'password' => Hash::make($request->password) //encriptando
        ]);

        //autenticando al usuario
        auth()->attempt([
            'email' => $request->email,
            'password' => $request->password
        ]);

        $user = User::find(auth()->user()->id);
        $roles = $user->getRoleNames();
        //return $roles;
        if ($roles->contains('Admin')) {
            return redirect()->route('admin.roles.index');
        } else if ($roles->contains('Instructor')) {
            Mail::to($request->email)->send(new MailUserBienvenida($user));
            return redirect()->route('admin.instructor.course.index');
        } else {
            Mail::to($request->email)->send(new MailUserBienvenida($user));
            return redirect()->route('visitador.course.list');
        }
    }
}
