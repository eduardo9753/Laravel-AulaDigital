@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Lista de Exámenes</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                @foreach ($courses as $course)
                    <div class="col-md-12 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">Exámenes de {{ $course->title }}</h2>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ($course->exams as $exam)
                            <div class="col-md-3 my-2">
                                <div class="mi-card">
                                    <div class="mi-card-content">
                                        <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>
                                        <div class="text-center">
                                            <img style="width: 100px;height: 100px;"
                                                src="https://cdn-icons-png.flaticon.com/512/10510/10510645.png"
                                                alt="">
                                        </div>
                                        <p class="contenido-bloques-parrafo mt-2">Tiempo estimado : {{ $exam->duracion }}
                                            minutos</p>

                                        @can('enrolledExamUser', $exam)
                                            @can('ExamUserStatus', $exam)
                                                <a href="{{ route('visitador.examenes.free.status', ['exam' => $exam]) }}"
                                                    class="btn btn-primary mt-2 w-100">Continuar el Examen</a>
                                            @else
                                                <a href="{{ route('visitador.examenes.free.show', ['exam' => $exam]) }}"
                                                    class="btn btn-outline-danger mt-2 w-100">Ver Resultados</a>
                                            @endcan
                                        @else
                                            <form id="inscribirmeForm_{{ $exam->id }}"
                                                action="{{ route('visitador.examenes.free.enrolled', ['exam' => $exam]) }}"
                                                method="GET">
                                                <button type="submit"
                                                    class="btn btn-outline-primary mt-2 w-100 inscribirme-btn">Inscribirme</button>
                                            </form>
                                        @endcan
                                    </div>

                                    <!-- Script para desactivar el botón después de hacer clic -->
                                    <script>
                                        $(document).ready(function() {
                                            $('#inscribirmeForm_{{ $exam->id }}').on('submit', function() {
                                                // Desactivar el botón inmediatamente después de hacer clic
                                                var $button = $(this).find('button');
                                                $button.prop('disabled', true).text('Inscribiendo...');
                                            });
                                        });
                                    </script>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endforeach
            </div>
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
                        académicos, <strong>al sistema de exámenes de todos los cursos</strong> y mucho más:<a
                            class="btn btn-primary text-white" target="_blank"
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
