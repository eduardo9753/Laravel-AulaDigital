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
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">

                    @foreach ($resources as $resource)
                        <div class="col-md-3 my-2">
                            <div class="mi-card">
                                <div class="mi-card-content">
                                    <h2 class="contenido-bloques-titulo">Lectura N° {{ $resource->id }}!</h2>
                                    <div class="text-center">
                                        <a href="{{ route('visitador.read.show', ['resource' => $resource]) }}"><img
                                                class="imagen" src="{{ $resource->img }}" alt=""></a>
                                    </div>

                                    <p class="contenido-bloques-parrafo">{{ $resource->nombre }}</p>

                                    <a href="{{ route('visitador.read.show', ['resource' => $resource]) }}"
                                        class="mi-boton general mt-2 w-100">Detalles</a>
                                </div>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection