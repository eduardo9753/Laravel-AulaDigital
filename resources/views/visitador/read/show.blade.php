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
                                <img src="{{ $resource->img }}" alt="..."
                                    style="width: 100%;height: 240px;border-radius: 10px">
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <strong>Referencia:</strong>
                                        <p>
                                            <strong>Recuperado de:</strong>
                                            <a target="_blank" href="{{ $resource->nombre }}"
                                                title="{{ $resource->nombre }}">
                                                {{ $resource->nombre }}
                                            </a>
                                        </p>
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>
                            </div>
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
