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

                        <div class="col-md-12 my-3">
                            <div id="flipbook">
                                <iframe style="width: 100%;height: 550px;" src="{{ $archive->url }}"
                                    title="Material educativo">
                                </iframe>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-10">
                                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                                        <p>
                                            <strong>Recuperado de:</strong>
                                            <a target="_blank" href="{{ $archive->cita }}" title="{{ $archive->cita }}">
                                                {{ $archive->cita }}
                                            </a>
                                        </p>

                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="text-center">
                                        <img src="{{ $course->image->url }}"
                                            style="width: 60px;height: 60px;border-radius: 50%"
                                            alt="{{ $archive->course->title }}"
                                            style="width: 100%;height: 240px;border-radius: 10px;object-fit: scale-down">
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
