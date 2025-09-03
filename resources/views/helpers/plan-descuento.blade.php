<!-- Popup -->
<div class="popup-overlay" id="popupOverlay">
    <span class="close" id="closePopup">&times;</span>

    <!-- Murciélagos -->
    <img src="https://cdn-icons-png.flaticon.com/512/4188/4188316.png" class="bat">
    <img src="https://cdn-icons-png.flaticon.com/512/685/685842.png" class="bat">
    <img src="https://cdn-icons-png.flaticon.com/512/3560/3560915.png" class="bat">

    <!-- Bruja volando -->
    <img src="https://cdn-icons-png.flaticon.com/512/12/12249.png" alt="witch" class="witch">


    <div class="popup-container">
        <input type="hidden" id="disparador" value="1">
        @foreach ($planes as $plan)
            <form action="{{ route('mercadopago.descuento.suscription.year.index', ['plan' => $plan->id]) }}"
                method="POST" class="form-suscription">
                @csrf
                <div class="popup">
                    <h2>🎃 Oferta Halloween 🎃</h2>
                    <p class="text-white">
                        ¡Aprovecha un <strong>{{ $plan->percentage }}% de descuento</strong>
                        en el plan <b>{{ $plan->name }}</b>!
                    </p>
                    <p class="mb-3 text-white">Usa el cupón:</p>

                    <input type="submit" class="btn-solid-sm p-4 mt-3 w-100 text-white"
                        value="SUSCRIBIRME ({{ strtoupper($plan->promo_code) }})">
                </div>
            </form>
        @endforeach
    </div>


</div>

<!-- Música -->
<audio id="musica" loop>
    <source src="https://verito-amor-aniversario.netlify.app/assets/musica/amor.mp3" type="audio/mpeg">
</audio>

<!-- Disparador oculto -->
<input type="hidden" id="disparador" value="1">

<script>
    const disparador = document.getElementById("disparador");
    const musica = document.getElementById("musica");
    const popupOverlay = document.getElementById("popupOverlay");
    const closePopup = document.getElementById("closePopup");

    // Cuando el modal aparece, arranca la música
    window.addEventListener("load", () => {
        setTimeout(() => {
            // Forzamos a mostrar el modal (ejemplo: con flex)
            popupOverlay.style.display = "flex";

            if (disparador.value === "1") {
                musica.play().catch(() => {
                    console.log(
                        "El navegador bloqueó el autoplay. Esperando clic del usuario...");
                    // En móviles/Chrome: arrancar con el primer clic del usuario
                    document.addEventListener("click", iniciarMusica, {
                        once: true
                    });
                });
            }
        }, 500);
    });

    function iniciarMusica() {
        musica.play();
    }

    // Cuando se cierra el modal, detener música
    closePopup.addEventListener("click", () => {
        popupOverlay.style.display = "none";
        musica.pause();
        musica.currentTime = 0; // reinicia a 0
    });
</script>
