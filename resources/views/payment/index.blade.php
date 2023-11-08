@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('header')
    <header class="header-pago-fondo" id="header-pago">
        <div class="contenedor text-center">
            <h3 class="ultimos-cursos-titulo text-white">Lo que aprendere {{ $course->title }}</h3>
            <p class="ultimos-cursos-parrafo text-white">no hay limites para aprender, eso está en ti</p>
        </div>
    </header>
@endsection


@section('main')
    <section class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <div class="alert alert-info alert-dismissible fade show" role="alert">
                    <strong>IMPORTANTE!</strong>
                    <p style="text-align: justify">Después de enviar el número de operación, el sistema verificará la
                        validez
                        del pago en un plazo de 24 horas. En
                        caso de que el número de operación sea correcto, se enviará un correo electrónico al estudiante
                        registrado
                        en la
                        plataforma con el estado del cobro. <strong>Si el número de operación no es correcto, se procederá a
                            revocar
                            el
                            permiso
                            para acceder al curso solicitado.</strong></p>
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
                <div class="col-md-4 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <div class="d-flex justify-content-around align-items-center">
                                <h2 class="contenido-bloques-titulo">Costo:</h2>
                                <p class="contenido-bloques-parrafo"
                                    style="font-size: 25px; color: var(--general);font-weight:bold">
                                    {{ $course->price->value }} S/.</p>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <form action="{{ route('yape.index', ['course' => $course]) }}" method="POST">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="number" class="form-label">N° de operación:</label>
                                            <input type="number" class="form-control" name="payment_id" id="payment_id"
                                                min="0" placeholder="N° de operación: 00099521" required>
                                            <div id="emailHelp" class="form-text">
                                                <p>Ingrese el número de operación.</p>
                                            </div>
                                        </div>
                                        <button type="submit" class="mi-boton general mt-2 w-100">Enviar Datos</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-4 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">{{ $course->title }}</h2>
                            <div class="text-center">
                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                    <img class="imagen" src="{{ $course->image->url }}" alt="">
                                </a>
                            </div>

                            <p class="contenido-bloques-parrafo mt-3">
                                {!! Str::limit($course->description, 150) !!}
                            </p>

                            <div class="d-flex justify-content-between mt-4">
                                <p>Matriculados({{ $course->students_count }})</p>
                                <ul class="d-flex">
                                    <li>
                                        <i class='bx bx-star {{ $course->rating >= 1 ? 'text-warning' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i class='bx bx-star {{ $course->rating >= 2 ? 'text-warning' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i class='bx bx-star {{ $course->rating >= 3 ? 'text-warning' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i class='bx bx-star {{ $course->rating >= 4 ? 'text-warning' : '' }}'></i>
                                    </li>
                                    <li>
                                        <i class='bx bx-star {{ $course->rating == 5 ? 'text-warning' : '' }}'></i>
                                    </li>
                                </ul>
                            </div>

                            <div class="d-flex justify-content-between align-items-center">
                                @if ($course->price->value == 0)
                                    <p style="font-size: 22px;font-weight:bold" class="color-general">
                                        {{ $course->price->name }}
                                        S/.0</p>
                                @else
                                    <p style="font-size: 22px; font-weight:bold" class="color-general">
                                        {{ $course->price->value }}
                                        S/.</p>
                                @endif

                                <p class="contenido-bloques-parrafo">Colaborador: {{ $course->teacher->name }}</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-4 my-2">
                    <div class="mi-card">
                        <div class="mi-card-content">
                            <h2 class="contenido-bloques-titulo">Qr Yape</h2>
                            <div class="text-center">
                                <img src="https://i.ibb.co/wy55yj5/qr.jpg" alt="qr" border="0">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="{{ asset('js/mercadopago.js') }}"></script>
@endsection
