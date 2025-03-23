<div>
    @if ($this->fileId)
        <a id="descargaArchivoCourseStatus" href="https://drive.google.com/uc?export=download&id={{ $fileId }}"
            class="mi-boton verde btn-sm mt-3" download>Descargar Archivo</a>
    @else
        <p class="mt-3">
            lección sin recurso
        </p>
    @endif
</div>
