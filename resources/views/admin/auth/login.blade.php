@extends('layouts.app')


@section('main')
    <div class="fondo login-fondo">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto mt-5">
                    <div class="card" style="opacity: 0.7">
                        <div class="card-header fondo-general text-center">
                            <h1>Login</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.login.store') }}" method="POST">

                                {{-- token de seguridad --}}
                                @csrf

                                {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                                @if (session('mensaje'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('mensaje') }}
                                    </div>
                                @endif

                                <!-- Email input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="email">Email address</label>
                                    <input type="email" name="email" id="email" class="form-control" />
                                    {{-- validacon con validate --}}
                                    @error('email')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                    {{-- validacon con validate --}}
                                    @error('password')
                                        <p class="text-danger">{{ $message }}</p>
                                    @enderror
                                </div>

                                <!-- 2 column grid layout for inline styling -->
                                <div class="row my-2">
                                    <div class="col d-flex justify-content-center">
                                        <!-- Checkbox -->
                                        <div class="form-check">
                                            <label class="form-check-label" for="remember"> Remember me </label>
                                            <input class="form-check-input" type="checkbox" name="remember"
                                                id="remember" />
                                        </div>
                                    </div>

                                    <div class="col">
                                        <!-- Simple link -->
                                        <a href="">Olvide mi Contraseña</a>
                                    </div>
                                </div>

                                <!-- Submit button -->
                                <input type="submit" class="mi-boton azul mb-4 w-100" value="Ingresar">

                                <!-- Register buttons -->
                                <div class="d-flex justify-content-between">
                                    <p><a class="btn btn-dark" href="{{ route('admin.register.index') }}">Registrarme</a>
                                    </p>

                                    <p><a class="btn btn-outline-dark" href="{{ route('visitador.home.index') }}">Ir a
                                            Casa</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
