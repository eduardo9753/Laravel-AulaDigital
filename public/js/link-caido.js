window.addEventListener('DOMContentLoaded', () => {
    $('#fromLinkCaido').on('submit', function (e) {
        e.preventDefault(); // Previene el comportamiento predeterminado del formulario.

        var form = this;
        var alertButton = $('#alertButton'); // Selección del botón con jQuery.

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: new FormData(form),
            processData: false,
            contentType: false,
            dataType: 'json',

            beforeSend: function () {
                // Cambia el texto del botón y lo desactiva.
                alertButton.prop('disabled', true).text('Procesando...');
            },

            success: function (data) {
                console.log(data);
                if (data.code === 1) {
                    Swal.fire({
                        position: "bottom-end",
                        icon: "success",
                        title: 'Tu alerta se envió: ' + data.msg.name,
                        showConfirmButton: false,
                        timer: 1500
                    });
                } else {
                    Swal.fire({
                        position: "bottom-end",
                        icon: "error",
                        title: 'Alerta no enviada: ' + data.msg,
                        showConfirmButton: false,
                        timer: 1500
                    });
                }
            },

            complete: function () {
                // Reactivar el botón y restaurar el texto.
                alertButton.prop('disabled', false).text('Alertar Link caido');
            },

            error: function () {
                Swal.fire({
                    position: "bottom-end",
                    icon: "error",
                    title: 'Ocurrió un error al enviar la alerta',
                    showConfirmButton: false,
                    timer: 1500
                });

                alertButton.prop('disabled', false).text('Alertar Link caido');
            }
        });
    });
});
