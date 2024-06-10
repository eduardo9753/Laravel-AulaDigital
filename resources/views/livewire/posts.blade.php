<div>
    @foreach ($posts as $post)
        <div class="mi-card mt-2">
            <div class="mi-card-content">
                <h1><strong>{{ $post->title }}</strong></h1>
                @if (in_array($post->id, $expandedPosts))
                    <p>{!! $post->content !!}</p>
                @else
                    <p>{!! Str::limit($post->content, 150) !!}</p> <!-- Muestra solo los primeros 200 caracteres -->
                @endif
                <a href="#" wire:click.prevent="toggleExpand({{ $post->id }})">
                    @if (in_array($post->id, $expandedPosts))
                        Leer menos
                    @else
                        Leer más
                    @endif
                </a>

                <div class="d-flex justify-content-between align-items-center mt-2">
                    @livewire('reactions', ['postId' => $post->id], key($post->id))
                    <p class="text-bold"><strong>{{ $post->created_at->diffForHumans() }}</strong></p>
                </div>
            </div>
        </div>
    @endforeach

    @if ($posts->count() < $this->perPage)
        <div class="d-block text-center mt-2">
            <div class="spinner-grow" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @else
        <div wire:loading wire:target='loadMore' class="d-block text-center mt-2">
            <div class="spinner-border" role="status">
                <span class="visually-hidden">Loading...</span>
            </div>
        </div>
    @endif

    <script>
        document.addEventListener('livewire:load', function() {
            window.addEventListener('scroll', function() {
                if (window.innerHeight + window.scrollY >= document.body.offsetHeight) {
                    @this.call('loadMore');
                }
            });
        });
    </script>
</div>
