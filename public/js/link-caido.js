window.addEventListener('DOMContentLoaded', () => {
    $('#fromLinkCaido').on('submit', function (e) {
        e.preventDefault();

        var form = this;
        var alertButton = document.getElementById('alertButton');

        // Desactivar el botón
        alertButton.disabled = true;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form), //datos del formulario
            processData: false,
            contentType: false,
            dataType: 'json',

            beforeSend: function () { },

            success: function (data) {
                console.log(data);
                if (data.code == 1) {
                    //alert(JSON.stringify(data.msg)); //USAS ESTO CUANDO SOLO RETORNAS TODO EL OBJETO DESDE TU METODO
                    //alert('Se dio aviso a los administradores del la lección : '+data.msg.name);
                    Swal.fire({
                        position: "bottom-end",
                        icon: "success",
                        title: 'tu alerta se envio: ' + data.msg.name,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    alert(data.msg);
                    Swal.fire({
                        position: "bottom-end",
                        icon: "error",
                        title: 'alerta no enviada: ' + data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },

            complete: function () {
                // Habilitar el botón nuevamente si es necesario
                alertButton.disabled = false;
            },

            error: function () {
                // En caso de error, habilitar el botón nuevamente
                alertButton.disabled = false;
            }
        });
    });
});
