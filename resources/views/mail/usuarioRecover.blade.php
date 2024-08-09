<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Recuperar Cuenta</title>
</head>

<body style="font-family: 'Arial', sans-serif;
background-color: #f1eff1e0;
margin: 0;
padding: 0;
margin: 20px;">
    <div style=" display: flex;
    justify-content: center;
    padding: 20px;">
        <div
            style=" max-width: 90%;
        width: 100%;
        background-color: #fff;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        padding: 20px;
        margin-top: 20px;
        margin-bottom: 20px;">
            <div style="text-align: center;
            margin-bottom: 20px;">
                <img src="{{ asset('img/logo/logo.png') }}" style=" width: 150px;
                height: 150px;"
                    alt="Logo">
            </div>

            <div
                style=" background-color: rgba(255, 255, 255, 0.842);
            border-radius: 10px;
            margin-bottom: 20px;
            padding: 20px;">
                <h1 style="color: blueviolet;">{{ $user->name }}</h1>
                <p style="font-size: 18px;">¡Correo registrado en nuestra base de datos, {{ $user->email }}!</p>
                <p>Le solicitamos hacer clic en el enlace siguiente para restablecer sus credenciales, por favor. <a
                        href="{{ route('admin.recover.index') }}">Recuperar Cuenta</a></p>
            </div>


            <div
                style=" margin-top: 20px;
            background-color: rgba(255, 255, 255, 0.842);
            border-radius: 10px;
            padding: 20px;">
                <h2 style="color: blueviolet;
                font-size: 20px;">Soporte</h2>
                <ul style="list-style: none;
                padding: 0;
                margin: 0;">
                    <li style="margin-bottom: 5px;"><a target="_bank"
                            href="https://www.linkedin.com/in/anthony-eduardo-nu%C3%B1ez-canchari-05b1371a0/"><i
                                class='bx bxl-linkedin-square tamanio-icon' style='color:#2229c7'></i></a></li>
                    <li style="margin-bottom: 5px;"><i class='bx bxl-whatsapp tamanio-icon'
                            style='color:#26c942'></i>preunicursos@gmail.com</li>
                </ul>
            </div>
        </div>
    </div>
</body>

</html>
