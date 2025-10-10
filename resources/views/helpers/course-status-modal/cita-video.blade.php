 <!-- Button trigger modal -->
 <button type="button" class="mi-boton general" data-bs-toggle="modal" data-bs-target="#MoldalReferenciaVideo">
     Referencia del vídeo:
 </button>

 <div class="modal fade" id="MoldalReferenciaVideo" tabindex="-1" aria-labelledby="MoldalReferenciaVideoLabel"
     aria-hidden="true">
     <div class="modal-dialog">
         <div class="modal-content">
             <div class="modal-header">
                 <h1 class="modal-title fs-5" id="MoldalReferenciaVideoLabel">Referencia
                     del vídeo</h1>
                 <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
             </div>
             <div class="modal-body">
                 @php
                     $url = $current->url;
                     $urlParts = parse_url($url);
                     $channelName = '';
                     $videoDate = '';

                     if (isset($urlParts['query'])) {
                         parse_str($urlParts['query'], $queryArray);
                         $channelName = $queryArray['ab_channel'] ?? '';
                         $videoDate = $queryArray['t'] ?? '';

                         if ($videoDate) {
                             $fecha = 'No disponible'; // Agrega el punto y coma aquí
                         } else {
                             $fecha = $videoDate;
                         }
                     }
                 @endphp

                 <div class="alert alert-info alert-dismissible fade show" role="alert">
                     <strong>Referencia del vídeo:</strong>
                     <p>Material extraído de la Web - {{ $current->name }} [Video].
                         YouTube. Publicado
                         por el
                         canal
                         <strong>{{ $channelName }}</strong>. Disponible en: <a target="_blank"
                             href="{{ $current->url }}" title="{{ $channelName }}">{{ $url }}</a>
                     </p>
                     <p class="mb-0">
                         <em>
                             <strong>Este material no es de propiedad de esta plataforma. Se cita la fuente para
                                 reconocer la veracidad y autenticidad del documento, con fines exclusivamente
                                 educativos y en beneficio de la comunidad estudiantil de
                                 <a href="https://preunicursos.com/">PreuniCursos.com</a>.</strong>
                         </em>
                     </p>
                     <button type="button" class="mi-boton general" data-bs-dismiss="alert" aria-label="Close"></button>
                 </div>
             </div>
             <div class="modal-footer">
                 <button type="button" class="mi-boton general" data-bs-dismiss="modal">Cerrar</button>
             </div>
         </div>
     </div>
 </div>
