<div>
    <div class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-3 my-2">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">{{ $course->title }}</h2>
                                <div class="text-center">
                                    <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                        <img class="imagen" src="{{ $course->image->url }}" alt="">
                                    </a>
                                </div>

                                {{-- <p class="contenido-bloques-parrafo">{!! Str::limit($course->description, 50) !!}</p> --}}

                                <div class="d-flex justify-content-between align-items-center mt-3 mb-2">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <i class='bx bxs-user-plus' style="font-size: 24px"></i>
                                        <p>({{ $course->students_count }})</p>
                                    </div>

                                    <ul class="d-flex justify-content-between align-items-center">
                                        <div>
                                            <p>{{ round($course->rating) }}</p>
                                        </div>

                                        <div class="d-flex">
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 1 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 2 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 3 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating >= 4 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                            <li>
                                                <i style='color:#da920f'
                                                    class='bx bx-star {{ $course->rating == 5 ? 'bx bxs-star' : '' }}'></i>
                                            </li>
                                        </div>
                                    </ul>
                                </div>



                                @if (optional($course->teacher->profile)->website)
                                    <a href="{{ $course->teacher->profile->website }}" target="_blank">
                                        <p class="contenido-bloques-parrafo mb-3 color-general">Colaborador:
                                            {{ $course->teacher->name }}</p>
                                    </a>
                                @else
                                    <p class="contenido-bloques-parrafo mb-3 color-general">Colaborador:
                                        {{ $course->teacher->name }}</p>
                                @endif



                                {{--
                                @if ($course->price->value == 0)
                                    <p style="font-size: 22px;font-weight:bold" class="color-general">
                                        {{ $course->price->name }}
                                        S/.0</p>
                                @else
                                    <p style="font-size: 22px; font-weight:bold" class="color-general">
                                        {{ $course->price->value }}
                                        S/.</p>
                                @endif 
                                --}}

                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}"
                                    class="mi-boton general mt-2 w-100">Detalles</a>


                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
