window.addEventListener('DOMContentLoaded', () => {

    let player;

    function onYouTubeIframeAPIReady() {
        player = new YT.Player('player', {
            videoId: '-wRDCRizijs', // Reemplaza 'VIDEO_ID' con tu ID de video de YouTube
            playerVars: {
                'autoplay': 1,
                'rel': 0, // Desactiva videos relacionados al final
                'modestbranding': 1 // Reduce el branding
            },
            events: {
                'onReady': onPlayerReady
            }
        });
    }

    function onPlayerReady(event) {
        event.target.playVideo();
    }

});