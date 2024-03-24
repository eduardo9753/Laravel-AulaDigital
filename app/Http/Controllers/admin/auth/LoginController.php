<?php

namespace App\Http\Controllers\admin\auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class LoginController extends Controller
{
    ///login
    public function index()
    {
        return view('admin.auth.login');
    }

    //store login
    public function store(Request $request)
    {
        //validaciones
        $this->validate($request, [
            'email' => 'required|email',
            'password' => 'required'
        ]);

        //autenticando con la base de datos
        if (!auth()->attempt($request->only('email', 'password'), $request->remember)) {
            return back()->with('mensaje', 'Tus credenciales estan incorrectas');
        } else {
            $user = User::find(auth()->user()->id);
            $roles = $user->getRoleNames();

            //return $roles;
            if ($roles->contains('Admin')) {
                return redirect()->route('admin.roles.index');
            } else if ($roles->contains('Instructor')) {
                return redirect()->route('admin.instructor.course.index');
            } else {
                return redirect()->route('visitador.course.list');
            }
        }



        //redireccionando al perfil del usuario
        return redirect()->route('visitador.home.index');
    }
}
