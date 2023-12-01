<div>
    @if (session()->has('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
    @endif

    <div class="contenedor pt-5">
        <h1 class="lead mt-5">Creacion de Preguntas</h1>
        <p>id topic {{ $this->topic_id }}</p>
        <div class="row">
            <div class="col-md-7">
                <form wire:submit.prevent="saveQuestion">

                    <div class="card">
                        <div class="card-body">
                            <div class="form-group my-2">
                                <label for="exam_id">Exámen:</label>
                                <select wire:model="exam_id" class="form-select" id="exam_id">
                                    @foreach ($exams as $exam)
                                        <option value="{{ $exam->id }}">{{ $exam->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="form-group my-2">
                                <label for="titulo">Titulo de la pregunta:</label>
                                <input wire:model="titulo" class="form-control" type="text" id="titulo">
                                @error('titulo')
                                    <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>


                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group my-2">
                                        <label for="dificultad">Dificultad:</label>
                                        <select wire:model="dificultad" class="form-select" id="dificultad">
                                            @foreach (['facil', 'intermedio', 'dificil'] as $nivel)
                                                <option value="{{ $nivel }}">{{ ucfirst($nivel) }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group my-2">
                                        <label for="puntos">Puntos:</label>
                                        <select wire:model="puntos" class="form-select" id="puntos">
                                            @for ($i = 1; $i <= 5; $i++)
                                                <option value="{{ $i }}">{{ $i }}</option>
                                            @endfor
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group my-2">
                                        <label for="topic_id">Tema:</label>
                                        <select wire:model="selectedTopicId" class="form-select" id="topic_id">
                                            @foreach ($topics as $topic)
                                                <option value="{{ $topic->id }}">{{ $topic->nombre }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <div class="card">
                        <div class="card-body">
                            <div class="form-group">
                                <label>Posibles Respuestas:</label>
                                @foreach ($respuestas as $index => $respuesta)
                                    <div class="row">
                                        <div class="col-md-9">
                                            <input class="form-control"
                                                wire:model="respuestas.{{ $index }}.titulo" type="text"
                                                placeholder="Escriba la posible respuesta">
                                        </div>

                                        <div class="col-md-3">
                                            <div class="d-flex gap-3 justify-content-between">
                                                <div class="d-flex">
                                                    <input wire:model="respuestas.{{ $index }}.es_correcta"
                                                        class="form-check-input" type="checkbox"
                                                        id="respuestas_{{ $index }}">
                                                    <label for="respuestas_{{ $index }}">Es Correcta</label>
                                                </div>

                                                <button type="button" class="btn btn-warning btn-sm"
                                                    wire:click="removeAnswer({{ $index }})">X</button>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                                <button type="button" class="mi-boton azul mt-3 w-100" wire:click="addAnswer">Generar
                                    Respuesta</button>
                            </div>
                        </div>
                    </div>

                    <div>
                        <button class="mi-boton rojo mt-3 w-100" type="submit">Guardar Pregunta</button>
                    </div>
                </form>
            </div>


            <div class="col-md-5">
                <div class="card sombra">
                    <div class="card-header fondo-general">
                        <h2 class="lead text-white">Lista de Preguntas</h2>
                    </div>
                    <div class="card-body table-responsive">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>ID</th>
                                    <th>Pregunta</th>
                                    <th>
                                        <i class='bx bx-edit-alt bx-tada'></i>
                                    </th>
                                    <th>
                                        <i class='bx bx-message-alt-x bx-burst'></i>
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($questions as $question)
                                    <tr>
                                        <td>{{ $question->id }}</td>
                                        <td>{{ $question->titulo }}</td>
                                        <td>
                                            <button class="mi-boton azul btn-sm"><i
                                                    class='bx bx-edit-alt bx-tada'></i></button>
                                        </td>
                                        <td>
                                            <button wire:click="delete({{ $question->id }})"
                                                class="mi-boton rojo btn-sm"><i
                                                    class='bx bx-message-alt-x bx-burst'></i></button>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                        <div class="alert alert-warning alert-dismissible fade show" role="alert">
                            <strong>Recordar!</strong> Una vez hayas creado el tema y el examen, necesitarás publicar el
                            examen y culminar el tema.
                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
