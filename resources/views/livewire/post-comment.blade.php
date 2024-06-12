<div>

    <div class="mi-card mt-2">
        <div class="mi-card-content">
            <div class="d-flex justify-content-between align-items-center">
                <small><strong>Por: {{ $post->user->name }}</strong></small>
            </div>


            <h1 class="contenido-bloques-titulo"><strong>{{ $post->title }}</strong></h1>


            @if (in_array($post->id, $expandedPosts))
                <p>{!! $post->content !!}</p>
            @else
                <p>{!! Str::limit($post->content, 550) !!}</p> <!-- Muestra solo los primeros 200 caracteres -->
            @endif
            <a href="#" wire:click.prevent="toggleExpand({{ $post->id }})">
                @if (in_array($post->id, $expandedPosts))
                    Leer menos
                @else
                    Leer más
                @endif
            </a>

            {{-- COMPONETE LIVEWIRE DE REACCIONES --}}
            <div class="d-flex justify-content-between align-items-center mt-2">
                @livewire('reactions', ['postId' => $post->id], key($post->id))
                <p class="text-bold"><strong>{{ $post->created_at->diffForHumans() }}</strong></p>
            </div>
            {{-- COMPONENTE LIVEWIRE DE REACCIONES --}}


            {{-- COMPONENTE LIVEWIRE DE COMMENTS-MULTIPLES --}}
            @livewire('comments', ['post' => $post], key('comments-' . $post->id))
            {{-- COMPONENTE LIVEWIRE DE COMMENTS-MULTIPLES --}}
        </div>
    </div>
</div>
