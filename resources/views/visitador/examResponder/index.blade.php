@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">{{ auth()->user()->name }}</h3>
            <p class="ultimos-cursos-parrafo text-white">Lista de Examenes</p>
        </div>
    </header>
@endsection



@section('main')
    <section>
        <div class="" id="contenido-bloques">
            <div class="contenedor">
                <div class="row">

                    @foreach ($exams as $exam)
                        <div class="col-md-3 my-2">
                            <div class="mi-card">
                                <div class="mi-card-content">
                                    <h2 class="contenido-bloques-titulo">{{ $exam->nombre }}</h2>
                                    <div class="text-center">
                                        <img style="width: 100px;height: 100px;"
                                            src="https://cdn-icons-png.flaticon.com/512/10510/10510645.png" alt="">
                                    </div>
                                    <p class="contenido-bloques-parrafo mt-2">Tiempo estimado : {{ $exam->duracion }}
                                        minutos</p>

                                    @can('enrolledExamUser', $exam)
                                        @can('ExamUserStatus', $exam)
                                            <a href="{{ route('visitador.examenes.status', ['exam' => $exam]) }}"
                                                class="mi-boton general mt-2 w-100">Continuar el Exámen</a>
                                        @else
                                            <a href="{{ route('visitador.examenes.show', ['exam' => $exam]) }}"
                                                class="mi-boton rojo mt-2 w-100">Ver Resultados</a>
                                        @endcan
                                    @else
                                        <a id="inscribirmeBtn_{{ $exam->id }}"
                                            href="{{ route('visitador.examenes.enrolled', ['exam' => $exam]) }}"
                                            class="mi-boton general mt-2 w-100">Inscribirme</a>
                                    @endcan

                                </div>

                                <script>
                                    $(document).ready(function() {
                                        $('a[id^="inscribirmeBtn_"]').on('click', function() {
                                            $(this).attr('disabled', true);
                                        });
                                    });
                                </script>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </div>
    </section>
@endsection
