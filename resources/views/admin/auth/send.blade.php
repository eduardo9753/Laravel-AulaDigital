@extends('layouts.app')


@section('main')
    <div class="fondo register-fondo">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto mt-4">
                    <div class="card" style="opacity: 0.8">
                        <div class="card-header fondo-general text-center">
                            <h1>Recuperar Cuenta</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.send') }}" method="POST">

                                {{-- token de seguridad --}}
                                @csrf

                                <div class="text-center alert alert-dark">Favor de ingresar el correo con el cual se
                                    registro en la plataforma</div>


                                @if (session('mensaje'))
                                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Mensaje!</strong> {{ session('mensaje') }}.
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                @endif




                                <!-- Email input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="form2Example1">Email address</label>
                                    <input type="email" id="email" name="email" class="form-control"
                                        value="{{ old('email') }}" />
                                    {{-- validacion con validate --}}
                                    @error('email')
                                        {{-- alerta de error --}}
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>



                                <!-- Submit button -->
                                <input type="submit" class="mi-boton general mb-4 w-100" value="Recuperar Cuenta">

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
