@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section id="" class="">
        <div class="container pt-5">
            <h1 class="lead mt-5">Asignar nuevo rol a: {{ $user->name }}</h1>
            <div class="row">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <a class="text-white" href="{{ route('admin.users.index') }}">Lista de Usuarios</a>
                    </div>
                    <div class="card-body">
                        {!! Form::model($user, ['route' => ['admin.users.update', $user], 'method' => 'put']) !!}

                        @foreach ($roles as $role)
                            <div>
                                <label>
                                    {!! Form::checkbox('roles[]', $role->id, null, ['class' => 'mr-1']) !!}
                                    {{ $role->name }}
                                </label>
                            </div>
                        @endforeach

                        {!! Form::submit('Asignar Rol', ['class' => 'mi-boton azul mt-2']) !!}

                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
