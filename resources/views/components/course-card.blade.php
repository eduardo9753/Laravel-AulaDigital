<div>
    <div class="" id="contenido-bloques">
        <div class="contenedor">
            <div class="row">
                @foreach ($courses as $course)
                    <div class="col-md-3 mb-3">
                        <div class="mi-card">
                            <div class="mi-card-content">
                                <h2 class="contenido-bloques-titulo">{{ $course->title }}</h2>
                                <div class="text-center">
                                    <a href="{{ route('visitador.course.show', ['course' => $course]) }}">
                                        <img class="imagen" src="{{ $course->image->url }}" alt="">
                                    </a>
                                </div>

                                <p class="contenido-bloques-parrafo mt-3">
                                    {{ Str::limit($course->description, 30) }}
                                </p>

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
                                    <p style="font-size: 22px;font-weight:bold" class="color-general">
                                        {{ $course->price->name }}
                                        S/.0</p>
                                @else
                                    <p style="font-size: 22px; font-weight:bold" class="color-general">
                                        {{ $course->price->value }}
                                        S/.</p>
                                @endif

                                <a href="{{ route('visitador.course.show', ['course' => $course]) }}"
                                    class="mi-boton general mt-2 w-100">Detalles</a>

                                <p class="contenido-bloques-parrafo mt-3">Colaborador: {{ $course->teacher->name }}</p>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</div>
