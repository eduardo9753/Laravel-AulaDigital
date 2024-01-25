@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection






@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <h2 class="contenido-bloques-titulo pt-4"></h2>

            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-3 my-3">
                            <div class="text-center">
                                <img src="{{ $resource->img }}" alt="..."
                                    style="width: 100%;height: 240px;border-radius: 10px;object-fit: scale-down">
                            </div>

                            <div class="card">
                                <div class="card-body">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <p>
                                            <strong>Recuperado de:</strong>
                                            <a target="_blank" href="{{ $resource->url }}" title="{{ $resource->nombre }}">
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
                            <div id="flipbook">
                                <iframe style="width: 100%;height: 550px;" src="{{ $resource->url }}"
                                    title="Material educativo">
                                </iframe>
                            </div>
                        </div>

                        <!-- Agrega las bibliotecas Turn.js -->
                        <script src="https://cdnjs.cloudflare.com/ajax/libs/turn.js/4.1.0/turn.min.js"></script>
                        <script>
                            // Inicializa el flipbook una vez que el contenido esté cargado
                            $("#flipbook").turn({
                                width: '100%',
                                height: 550,
                                autoCenter: true
                            });
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
