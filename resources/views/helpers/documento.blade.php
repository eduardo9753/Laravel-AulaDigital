<div class="mi-card">
    <div class="mi-card-content">
        <div class="row">

            <div class="col-md-8 my-1">
                <div id="flipbook">
                    <iframe style="width: 100%;height: 550px;" src="{{ $archive->url }}" title="Material educativo">
                    </iframe>
                </div>
            </div>

            <div class="col-md-4">
                <div class="mi-card">
                    <div class="mi-card-content">
                        <div class="text-center">
                            @php
                                // Extraer el ID del archivo de Google Drive de la URL
                                $fileId = null;
                                if (preg_match('/\/d\/([a-zA-Z0-9_-]+)/', $archive->url, $matches)) {
                                    $fileId = $matches[1];
                                }
                            @endphp

                            @if ($fileId)
                                <a href="https://drive.google.com/uc?export=download&id={{ $fileId }}"
                                    class="btn btn-primary" download>Descargar Archivo</a>
                            @else
                                <p>No se pudo generar el enlace de descarga.</p>
                            @endif
                        </div>
                        <div class="text-center mt-3">
                            <img src="{{ $course->image->url }}" style="width: 120px;height: 120px;"
                                alt="{{ $archive->course->title }}"
                                style="width: 100%;height: 240px;border-radius: 10px;object-fit: scale-down">
                        </div>

                        <div class="card-footer">
                            <p>{{ $archive->name }}</p>
                          </div>
                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="mi-card">
                    <div class="mi-card-content">
                        <div class="alert alert-info alert-dismissible fade show" role="alert">
                            <p>
                                <strong>Recuperado de:</strong>
                                <a target="_blank" href="{{ $archive->cita }}" title="{{ $archive->cita }}">
                                    {{ $archive->cita }}
                                </a>
                            </p>

                            <button type="button" class="btn-close" data-bs-dismiss="alert"
                                aria-label="Close"></button>
                        </div>
                    </div>
                </div>


            </div>
        </div>
    </div>
</div>
