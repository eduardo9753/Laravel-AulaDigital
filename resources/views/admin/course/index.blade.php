@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">lista de Cursos Pendientes de aprobación</h1>
            <div class="row">
                <div class="card sombra">
                    @if (session('info'))
                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Mensaje!</strong>{{ session('info') }}.
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif
                    <div class="card-header fondo-general">
                        <p>Lista</p>
                    </div>
                    <div class="card-body">

                        <table class="table" id="datatable">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>NOMBRE</th>
                                    <th>CATEGORIA</th>
                                    <th>EDITAR</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $item)
                                <tr>
                                    <td>{{ $course->id }}</td>
                                    <td>{{ $course->title }}</td>
                                    <td>{{ $course->category->name }}</td>
                                    <td>
                                        <a class="mi-boton azul"
                                            href="{{ route('admin.courses.show', ['course' => $course]) }}">Revisar</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
