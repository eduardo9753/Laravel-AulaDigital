@extends('layouts.app')


@section('navegador')
    @include('template.nav-visitador')
@endsection


@section('main')
    <section class="mt-4" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                <div class="col-md-8">
                    @livewire('post-comment', ['post' => $post], key($user->id))
                </div>


                <div class="col-md-4">
                    @foreach ($randomPosts as $post)
                        <div class="mi-card my-2">
                            <div class="mi-card-content">
                                <a href="{{ route('visitador.post.comment', ['post' => $post]) }}">
                                    <h1 class="lead"><strong>{{ $post->title }}</strong></h1>
                                </a>

                                <div class="d-flex justify-content-between align-items-center">
                                    <small><strong>Por: {{ $post->user->name }} -
                                            {{ $post->created_at->diffForHumans() }}</strong></small>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
        </div>
    </section>

    @include('template.footer')
@endsection
