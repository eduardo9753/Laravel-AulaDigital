@extends('layouts.app')


@section('main')
    <div class="fondo register-fondo">
        <div class="container">
            <div class="row">
                <div class="col-md-6 mx-auto mt-4">
                    <div class="card" style="opacity: 0.7">
                        <div class="card-header fondo-general text-center">
                            <h1>Registrate</h1>
                        </div>
                        <div class="card-body">
                            <form action="{{ route('admin.register.store') }}" method="POST">

                                {{-- token de seguridad --}}
                                @csrf

                                <!-- Email input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="name">Nombre</label>
                                    <input type="text" id="name" name="name" class="form-control"
                                        value="{{ old('name') }}" />
                                    {{-- validacion con validate --}}
                                    @error('name')
                                        {{-- alerta de error --}}
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

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

                                <!-- Password input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="password">Password</label>
                                    <input type="password" id="password" name="password" class="form-control" />
                                    {{-- validacion con validate --}}
                                    @error('password')
                                        {{-- alerta de error --}}
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Password input -->
                                <div class="form-outline my-2">
                                    <label class="form-label" for="password_confirmation">Password Confirmation</label>
                                    <input type="password" id="password_confirmation" name="password_confirmation"
                                        class="form-control" />
                                    {{-- validacion con validate --}}
                                    @error('password_confirmation')
                                        {{-- alerta de error --}}
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <!-- Submit button -->
                                <input type="submit" class="mi-boton azul btn-block mb-4 w-100" value="Registrarme">

                                <!-- Register buttons -->
                                <div class="d-flex justify-content-between">
                                    <p><a class="btn btn-dark" href="{{ route('login') }}">Login</a></p>

                                    <p><a class="btn btn-outline-dark" href="{{ route('visitador.home.index') }}">Ir a Casa</a></p>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
