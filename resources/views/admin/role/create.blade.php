@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">Nuevo Rol</h1>
            <div class="row">
                <div class="card">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="{{ route('admin.roles.index') }}">Lista de Roles</a>
                    </div>
                    <div class="card-body">
                        {!! Form::open(['route' => 'admin.permissions.store']) !!}

                        @include('admin.role.partials.form')

                        {!! Form::submit('Crear Permisos', ['class' => 'btn btn-success mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
