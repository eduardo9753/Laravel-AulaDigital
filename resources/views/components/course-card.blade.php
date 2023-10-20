<div>
    <!-- Simplicity is an acquired taste. - Katharine Gerould -->
    <div class="row">
        @foreach ($courses as $course)
            <div class="col-md-3 my-2">
                <div class="card sombra" style="width: 100%;">
                    <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                        <img src="{{ $course->image->url }}" class="card-img-top" alt="...">
                    </a>

                    <div class="card-body">
                        <h4 class="ultimos-cursos-card-titulo">{{ $course->title }}</h4>
                        <p class="ultimos-cursos-card-parrafo">{{ Str::limit($course->description, 40) }}</p>
                        <p class="ultimos-cursos-card-parrafo mt-3">Colaborador: {{ $course->teacher->name }}</p>

                        <div class="d-flex justify-content-between">
                            <p>Matriculados({{ $course->students_count }})</p>
                            <ul class="d-flex">
                                <li>
                                    <i class='bx bx-star {{ $course->rating >= 1 ? 'text-warning' : '' }}'></i>
                                </li>
                                <li>
                                    <i class='bx bx-star {{ $course->rating >= 2 ? 'text-warning' : '' }}'></i>
                                </li>
                                <li>
                                    <i class='bx bx-star {{ $course->rating >= 3 ? 'text-warning' : '' }}'></i>
                                </li>
                                <li>

                                </li><i class='bx bx-star {{ $course->rating >= 4 ? 'text-warning' : '' }}'></i>
                                <li>
                                    <i class='bx bx-star {{ $course->rating == 5 ? 'text-warning' : '' }}'></i>
                                </li>
                            </ul>
                        </div>

                        @if ($course->price->value == 0)
                            <p style="font-size: 22px;font-weight:bold" class="color-general"> {{ $course->price->name }}
                                S/.0</p>
                        @else
                            <p style="font-size: 22px; font-weight:bold" class="color-general">{{ $course->price->value }}
                                S/.</p>
                        @endif


                        <a href="{{ route('visitador.course.show', ['course' => $course]) }}"
                            class="mi-boton general mt-2 w-100">Detalles</a>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
