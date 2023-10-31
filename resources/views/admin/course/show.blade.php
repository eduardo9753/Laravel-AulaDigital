@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    {{-- DESCRIPCION DEL CURSO Y SUS CARACTERISTICAS --}}
    <section id="curso-show" class="">
        <div class="container">
            <div class="row">
                <div class="col-md-6">
                    <figure>
                        <img src="{{ $course->image->url }}" class="" alt="...">
                    </figure>
                </div>
                <div class="col-md-6 curso-show-descripcion">
                    <div>
                        <h2 class="curso-show-titulo">{{ $course->title }}</h2>
                        <h3 class="curso-show-subtitulo">{{ $course->subtitle }}</h3>
                        <p>Nivel: {{ $course->level->name }}</p>
                        <p>Categoria: {{ $course->category->name }}</p>
                        <p>Matriculado: {{ $course->students_count }}</p>
                        <p>Calificación: {{ $course->rating }}</p>
                    </div>
                </div>
            </div>
        </div>
    </section>
    {{-- DESCRIPCION DEL CURSO Y SUS CARACTERISTICAS --}}


    <div class="curso-shoe-columna-ocho">
        <div class="contenedor">
            <div class="row">
                {{-- COLUMNA IZQUIERDA --}}
                <div class="col-md-8 mt-3">
                    {{-- INPRIMIENDO LAS METAS --}}
                    <section class="">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="color-general">Lo que aprenderás</h3>
                                <ul class="row">
                                    @foreach ($course->goals as $goal)
                                        <div class="col-md-6">
                                            <div class="d-flex align-items-center">
                                                <i class='bx bx-bullseye' style='color:#0d6efd;margin-right: 3px'></i>
                                                <li class="">{{ $goal->name }}</li>
                                            </div>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LAS METAS --}}


                    {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}
                    <section>
                        <h3 class="mt-4 mb-3 color-general">Temario</h3>
                        @foreach ($course->sections as $section)
                            <div class="card mt-2">
                                <div class="card-body">
                                    {{-- PARA QUE EL PRIMER SECTION ESTE ABIERTO --}}
                                    <article
                                        @if ($loop->first) x-data="{ open: true }"
                                @else
                                x-data="{ open: false }" @endif>
                                        <header class="link-primary" x-on:click="open= !open">
                                            <h4 class="lead cursor-show"> <i class="bx bx-chevron-down bx-flip-"></i>
                                                {{ $section->name }}</h4>
                                        </header>
                                        {{-- INPRIMIENDO LAS LECCIONES DE CADA SECCION --}}
                                        <div class="bg-white py-2 px-4" x-show="open">
                                            <ul>
                                                @foreach ($section->lessons as $lesson)
                                                    <li class="d-flex align-items-center my-1">
                                                        <i class='bx bx-play-circle'
                                                            style='color:#4b22f4 ; font-size: 22px'></i>
                                                        <p>{{ $lesson->name }}</p>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                        {{-- INPRIMIENDO LAS LECCIONES DE CADA SECCION --}}
                                    </article>
                                </div>
                            </div>
                        @endforeach
                    </section>
                    {{-- INPRIMIENDO LAS SECCIONES DE LOS CURSOS --}}


                    {{-- INPRIMIENDO LOS REQUERIMIENTOS --}}
                    <section class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3 color-general">Requisitos</h3>
                                <ul>
                                    @foreach ($course->requirements as $requirement)
                                        <div class="d-flex align-items-center">
                                            <i class='bx bx-check-square' style='color:#4b22f4;margin-right: 3px'></i>
                                            <li>{{ $requirement->name }}</li>
                                        </div>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LOS REQUERIMIENTOS --}}


                    {{-- INPRIMIENDO LA DESCRIPCION DEL CURSO --}}
                    <section class="mt-3">
                        <div class="card">
                            <div class="card-body">
                                <h3 class="mb-3 color-general">Descripción</h3>
                                <div class="d-flex align-items-center">
                                    <i class='bx bxs-hand-right' style='color:#4b22f4;margin-right: 3px'></i>
                                    <p class="">{!! $course->description !!}</p>
                                </div>
                            </div>
                        </div>
                    </section>
                    {{-- INPRIMIENDO LA DESCRIPCION DEL CURSO --}}
                </div>
                {{-- COLUMNA IZQUIERDA --}}



                {{-- COLUMNA DERECHA --}}
                <div class="col-md-4 mt-3">
                    <section>
                        <div class="card">
                            <div class="card-body">
                                <div class="d-flex item-center">
                                    <img src="{{ $course->teacher->profile_photo_url }}" alt="">
                                    <div>
                                        <p>Calaborador:{{ $course->teacher->name }}</p>
                                        <a href="#">{{ '@' . Str::slug($course->teacher->name, '') }}</a>
                                    </div>
                                </div>

                                <form action="{{ route('admin.courses.approved', ['course' => $course]) }}" method="POST">
                                    @csrf
                                    <button class="mi-boton rojo mt-3 w-100" type="submit">Aprobar este curso</button>
                                </form>
                            </div>
                        </div>
                    </section>
                </div>
                {{-- COLUMNA DERECHA --}}
            </div>
        </div>
    </div>
@endsection
