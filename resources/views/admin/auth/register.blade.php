@extends('layouts.app')


@section('main')
    <section class="vh-100">
        <div class="wrapper">
            <div class="inner">
                <img src="{{ asset('images/login/image-1.png') }}" alt="" class="image-1">
                <form class="form" action="{{ route('admin.register.store') }}" method="POST">

                    {{-- token de seguridad --}}
                    @csrf

                    {{-- MENSAJE SI ESTAN MAL LAS CREDENCIALES --}}
                    @if (session('mensaje'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('mensaje') }}
                        </div>
                    @endif
                    <div class="d-flex justify-content-between">
                        <h3>Registrarme</h3>
                        <div> <a class="btn-solid-sm" href="{{ route('visitador.home.index') }}">Casa</a></div>
                    </div>

                    <div class="form-holder">
                        <span><i class='bx bx-user-check'></i></span>
                        <input type="text" id="name" name="name" class="form-control" value="{{ old('name') }}"
                            placeholder="Tu nombre o nombre de usuario" />
                    </div>
                    @error('name')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-envelope'></i></i></span>
                        <input type="email" name="email" value="{{ old('email') }}" id="email" class="form-control"
                            placeholder="Tu Gmail" />
                    </div>
                    @error('email')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password" name="password" class="form-control"
                            placeholder="**********" />
                    </div>
                    @error('password')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror

                    <div class="form-holder">
                        <span><i class='bx bx-barcode'></i></span>
                        <input type="password" id="password_confirmation" name="password_confirmation" class="form-control"
                            placeholder="**********" />
                    </div>
                    @error('password_confirmation')
                        {{-- alerta de error --}}
                        <span class="text-danger">{{ $message }}</span>
                    @enderror

                    <button class="button-login">
                        <span>Registrarme</span>
                    </button>
                </form>
                <img src="{{ asset('images/login/image-2.png') }}" alt="" class="image-2">
            </div>

        </div>
    </section>
@endsection
