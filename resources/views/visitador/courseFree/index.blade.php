@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-course-fondo" id="header-home">
        <div class="contenedor">
            {{-- COMPONENTE LIVEWIRE BUSCADOR --}}
            @livewire('search')
        </div>
    </header>
@endsection


@section('main')
    <section id="ultimos-cursos" class="text-center">
        <h3 class="ultimos-cursos-titulo color-general">Cursos gratis</h3>
        <p class="ultimos-cursos-parrafo color-general"></p>

        {{-- MENSAJE DE ALERTA CUANDO TE SUSCRIBES --}}
        <div class="contenedor">
            @if (session('mensaje'))
                <div class="alert alert-info mt-2 alert-dismissible fade show" role="alert">
                    <strong>Importante!:</strong> {{ session('mensaje') }}.
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif
        </div>

        <div class="">
            {{-- LLAMADA DEL COMPONENTE COURSE CARD FREE --}}
            @if (auth()->check())
                <x-course-card :courses="$courses" url="gratis"></x-course-card>
            @else
                <x-course-card :courses="$courses" url="premium"></x-course-card>
            @endif
        </div>
    </section>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="alert alert-info alert-dismissible fade show mt-3" role="alert">
                    <strong>Suscribete:</strong>
                    <p>
                        Suscríbete a nuestros planes y obtén acceso ilimitado a todos los cursos, material
                        educativo,
                        contenidos
                        académicos, al sistema de exámenes y mucho más:<a class="btn btn-primary text-white" target="_blank"
                            href="{{ route('mercadopago.suscription.subscribe') }}" title="suscripcion">
                            suscribirme
                        </a>
                    </p>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
            </div>
        </div>
    </div>

    @include('template.footer')
@endsection
