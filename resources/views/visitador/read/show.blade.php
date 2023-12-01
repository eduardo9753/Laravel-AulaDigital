@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection






@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <h2 class="contenido-bloques-titulo pt-4">Lectura N° {{ $resource->id }}</h2>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 my-3">
                            <div class="text-center">
                                <img src="{{ $resource->img }}" alt="..." style="width: 100%;height: 240px;border-radius: 10px">
                            </div>

                            <p class="mt-4">Material extraído. Fuente: <cite><a target="_blank"
                                        href="{{ $resource->nombre }}">{{ $resource->nombre }}</a></cite>
                            </p>
                        </div>
                        <div class="col-md-9 my-3">
                            <iframe style="width: 100%;height: 550px;" src="{{ $resource->url }}"
                                title="W3Schools Free Online Web Tutorials">
                            </iframe>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
