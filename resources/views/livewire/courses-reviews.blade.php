<div>
    {{-- To attain knowledge, add things every day; To attain wisdom, subtract things every day. --}}
    <div class="card mt-3">
        <div class="card-body">
            <h3 class="color-general">Reseñas <small>({{ $course->reviews->count() }})</small> </h3>

            <div style="max-height: 300px; overflow-y: auto;">
                @can('enrolled', $course)
                    <article class="my-3">
                        @can('valued', $course)
                            <form wire:submit.prevent="create">
                                <textarea wire:model="comment" rows="3" class="form-control w-100 mb-2" placeholder="Ingrese una reseña del curso"></textarea>
                                @error('comment')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror

                                <div class="d-flex justify-content-between align-items-center">
                                    <button type="submit" class="mi-boton general">Agregar Comentario</button>

                                    <ul class="d-flex">
                                        <li wire:click="$set('rating',1)">
                                            <i style='color:#da920f; font-size:30px'
                                                class='bx bx-star {{ $rating >= 1 ? 'bx bxs-star' : '' }}'></i>
                                        </li>
                                        <li wire:click="$set('rating',2)">
                                            <i style='color:#da920f; font-size:30px'
                                                class='bx bx-star {{ $rating >= 2 ? 'bx bxs-star' : '' }}'></i>
                                        </li>
                                        <li wire:click="$set('rating',3)">
                                            <i style='color:#da920f; font-size:30px'
                                                class='bx bx-star {{ $rating >= 3 ? 'bx bxs-star' : '' }}'></i>
                                        </li>
                                        <li wire:click="$set('rating',4)">
                                            <i style='color:#da920f; font-size:30px'
                                                class='bx bx-star {{ $rating >= 4 ? 'bx bxs-star' : '' }}'></i>
                                        </li>
                                        <li wire:click="$set('rating',5)">
                                            <i style='color:#da920f; font-size:30px'
                                                class='bx bx-star {{ $rating == 5 ? 'bx bxs-star' : '' }}'></i>
                                        </li>
                                    </ul>
                                </div>
                            </form>
                        @else
                            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                                <strong>{{ auth()->user()->name }}!</strong> Ya dejaste tu reseña en este curso 😊.
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div>
                        @endcan
                    </article>
                @else
                    <div class="alert alert-info alert-dismissible fade show" role="alert">
                        <strong>Hola!</strong> ¡Inscríbete en el curso y comparte tu opinión! 😊.
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endcan

                @foreach ($course->reviews as $review)
                    <article>

                        <figure class="d-flex justify-content-between align-items-center">
                            <div class="d-flex justify-content-between align-items-center">
                                <img style="width: 15px;height: 15px;"
                                    src="https://cdn-icons-png.flaticon.com/512/560/560277.png" alt="">

                                <p class="pr-2"><b>{{ $review->user->name }}</b>
                                </p>
                            </div>

                            <p class="pr-2">{{ $review->rating }}<i class='bx bxs-star' style='color:#da920f'></i>
                                @if ($review->created_at)
                                    - <strong>{{ $review->created_at->diffForHumans() }}</strong>
                                @else
                                    <strong>(Fecha no disponible)</strong>
                                @endif
                            </p>
                        </figure>

                        <div>
                            <p>{{ $review->comment }}</p>
                        </div>

                    </article>
                    <hr>
                @endforeach
            </div>
        </div>
    </div>
</div>
