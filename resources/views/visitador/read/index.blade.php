@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Recursos Descargables</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">
                    <div id="accordion">
                        @foreach ($courses as $course)
                            <div class="accordion-item">
                                <h2 class="accordion-header" id="heading{{ $course->id }}">
                                    <button class="accordion-button {{ $loop->first ? '' : 'collapsed' }}" type="button"
                                        data-bs-toggle="collapse" data-bs-target="#{{ $course->id }}"
                                        aria-expanded="{{ $loop->first ? 'true' : 'false' }}"
                                        aria-controls="{{ $course->id }}">
                                        {{ $course->title }}
                                    </button>
                                </h2>
                                <div id="{{ $course->id }}"
                                    class="accordion-collapse collapse {{ $loop->first ? 'show' : '' }}"
                                    aria-labelledby="heading{{ $course->id }}" data-bs-parent="#accordionExample">
                                    <div class="accordion-body">
                                        <ul>
                                            @foreach ($course->archives as $archive)
                                                <a href="{{ route('visitador.read.show', ['archive' => $archive]) }}">
                                                    <li class="d-flex align-items-center my-1">
                                                        <i class='bx bxs-file-pdf' style='color:#310fc7'></i>
                                                        <p class="temario-parrafo">{{ $archive->name }}</p>
                                                    </li>
                                                </a>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div>
            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
