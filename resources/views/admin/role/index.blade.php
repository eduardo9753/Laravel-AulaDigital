@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">lista de roles</h1>
            <div class="row">
                <div class="card">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="{{ route('admin.permissions.create') }}">Crear Nuevo Permiso</a>
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
                                        <th>ROLES</th>
                                        <th>ELIMINAR</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse ($roles as $role)
                                        <tr>
                                            <td>{{ $role->id }}</td>
                                            <td>{{ $role->name }}</td>

                                            <td>
                                                <a class="mi-boton azul"
                                                    href="{{ route('admin.roles.edit', ['role' => $role]) }}">editar
                                                    roles</a>
                                            </td>

                                            <td>
                                                <form action="{{ route('admin.roles.destroy', ['role' => $role]) }}"
                                                    method="POST">
                                                    @csrf
                                                    @method('delete')
                                                    <button class="mi-boton rojo">Eliminar</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @empty
                                        <tr>
                                            <td>Sin Roles por ahora</td>
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
