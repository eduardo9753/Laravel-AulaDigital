@extends('layouts.app')


@section('navegador')
    @include('template.nav-instructor')
@endsection




@section('main')
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Crear Curso</h1>
            <div class="row">

                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <h2 class="lead text-white">INFORMACIÓN DEL CURSO</h2>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.instructor.course.store']) !!}

                        @include('instructor.course.partials.form')

                        <div class="mt-2">
                            {!! Form::submit('Crear Curso', ['class' => 'mi-boton azul w-100']) !!}
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/instructor/ckeditor.js') }}"></script>
@endsection
