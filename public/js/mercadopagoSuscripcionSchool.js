window.addEventListener('DOMContentLoaded', () => {
    $('#form-suscription-school').on('submit', function (e) {
        e.preventDefault();

        var form = this;

        $.ajax({
            url: $(form).attr('action'),
            method: $(form).attr('method'),
            data: $(form).serialize(),  // Envía los datos del formulario
            dataType: "JSON",

            beforeSend: function () { },

            success: function (data) {
                console.log(data);
                if (data.code == 1) {
                    window.location.href = data.msg;
                } else {
                    alert(data.msg);
                }
            }
        });
    });
});
