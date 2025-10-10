@if ($current->description)
    <!-- Button trigger modal -->
    <button type="button" class="mi-boton general mt-3" data-bs-toggle="modal"
        data-bs-target="#ModalMaterialReferencia">
        Referencia del Material:
    </button>

    <!-- Modal cita del material-->
    <div class="modal fade" id="ModalMaterialReferencia" tabindex="-1" aria-labelledby="ModalMaterialReferenciaLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="ModalMaterialReferenciaLabel">
                        Referencia del
                        Material:</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="card">
                        <div class="card-body">
                            <div class="alert alert-info alert-dismissible fade show" role="alert">
                                <strong>Referencia del Material:</strong>
                                <p>
                                    Universidad Nacional Federico Villarreal. (2018).
                                    {{ $course->title }}.
                                    <strong>Recuperado de:</strong>
                                    <a target="_blank" href="{{ $current->description->name }}"
                                        title="{{ $current->description->name }}">
                                        {{ $current->description->name }}
                                    </a>
                                </p>
                                <p class="mb-0">
                                    <em>
                                        <strong>Este material no es de propiedad de esta plataforma. Se cita la fuente
                                            para
                                            reconocer la veracidad y autenticidad del documento, con fines
                                            exclusivamente
                                            educativos y en beneficio de la comunidad estudiantil de
                                            <a href="https://preunicursos.com/">PreuniCursos.com</a>.</strong>
                                    </em>
                                </p>
                                <button type="button" class="mi-boton general" data-bs-dismiss="alert"
                                    aria-label="Close"></button>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="mi-boton general" data-bs-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>
@endif
