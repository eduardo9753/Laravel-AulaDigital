@extends('layouts.app')


@section('main')
    <section class="vh-100">
        <div class="wrapper">
            <div class="inner">
                <img src="{{ asset('img/login/image-1.png') }}" alt="" class="image-1">
                <form class="form" action="{{ route('admin.login.store') }}" method="POST">

                    {{-- token de seguridad --}}
                    @csrf

                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                    @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <h3 class="h3-login">Acceder</h3>
                        <div> <a class="btn-solid-sm" href="{{ route('visitador.home.index') }}">Casa</a></div>
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-envelope'></i></i></span>
                        <input type="email" value="{{ old('email') }}" name="email" id="email" class="form-control"
                            placeholder="Tu Gmail" />
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="**********" />
                    </div>
                    {{-- validacon con validate --}}
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <!-- 2 column grid layout for inline styling -->
                    <div class="row my-2">
                        <div class="col d-flex justify-content-center">
                            <!-- Checkbox -->
                            <div class="form-check d-flex">
                                <label class="form-check-label" for="remember"> Recordarme </label>
                                <input class="form-check-input" type="checkbox" name="remember" id="remember" />
                            </div>
                        </div>

                        <div class="col">
                            <!-- Simple link -->
                            <a href="{{ route('admin.recover') }}">mi Contraseña?</a>
                        </div>
                    </div>

                    <button class="button-login">
                        <span>Ingresar</span>
                    </button>
                </form>
                <img src="{{ asset('img/login/image-2.png') }}" alt="" class="image-2">
            </div>

        </div>
    </section>
@endsection
