@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">lista de Usuarios</h1>
            <div class="row">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="">nuevo enlace</a>
                    </div>
                    <div class="card-body">
                        @if (session('exito'))
                            <div class="alert alert-primary alert-dismissible fade show" role="alert">
                                <strong>Mensaje!</strong> {{ session('exito') }}
                                <button type="button" class="btn-close" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        @endif

                        <div class="table-responsive">
                            <table class="table" id="datatable">
                                <thead>
                                    <tr>
                                        <th>ID</th>
                                        <th>NOMBRE</th>
                                        <th>EMAIL</th>
                                        <th>EDITAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($users as $user)
                                        <tr>
                                            <td>{{ $user->id }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>
                                                <a class="mi-boton azul"
                                                    href="{{ route('admin.users.edit', ['user' => $user]) }}">edit</a>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Sin Usuarios por ahora</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
