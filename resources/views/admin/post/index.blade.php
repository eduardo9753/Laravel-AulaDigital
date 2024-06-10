@extends('layouts.app')


@section('navegador')
    @include('template.nav-admin')
@endsection




@section('main')
    <section>
        <div class="contenedor pt-5">
            <h1 class="lead mt-5">Crear Publicación</h1>
            <div class="row">

                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <h2 class="lead text-white">INFORMACIÓN DE LA PUBLICACIÓN</h2>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('admin.posts.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="">Titulo de la publicación</label>
                                <input type="text" class="form-control" name="title" placeholder="titulo del post">
                                @error('title')
                                    <p class="text-danger">{{ $message }}</p>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="">Contenido</label>
                                <textarea name="content" id="description" cols="30" rows="10" class="form-control"
                                    placeholder="Descripción del post"></textarea>
                               
                            </div>

                            <div>
                                <input type="submit" class="mi-boton rojo" value="Publicar">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="https://cdn.ckeditor.com/ckeditor5/40.0.0/classic/ckeditor.js"></script>
    <script src="{{ asset('js/instructor/ckeditor.js') }}"></script>
@endsection
