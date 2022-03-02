<table style="border-top:3px solid #5AB248;border-bottom:3px solid #5AB248;" width="600" align="center">
    <tbody>
        <tr>
            <td style="padding-left:20px;padding-right: 20px;">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tbody>
                        <tr><td>
                            <p style="color:#5AB248;margin: 0;padding-top: 10px;padding-bottom: 10px;font-size: 16px;"><b>¡Bienvenido(a), {{$name}}!</b></p>
                            <p style="color:#808080;margin: 0;font-size: 16px;"><b>Te ha llegado este correo porque te hemos creado una cuenta en <span style="color:#5AB248">{{ config('app.name', 'Laravel') }}</span>.</b></p>
                        </td></tr>
                        <tr><td>
                            <center><img src="{{ asset('public/images/logo.png')}}" width="180"></center>
                        </td></tr>
                    </tbody>
                </table>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;padding-top: 10px;">
                <p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Para culminar con tu registro debes activar tu cuenta creando una contraseña. Por favor, ingresa <a href="{{url('/activate/'.$code)}}" style="color: #5AB248;">aquí</a>.</p>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;"><p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Atentamente,</p>
                <p style="color:#5AB248;margin: 0;padding-bottom: 20px;font-size: 16px;"><b>El equipo de {{ config('app.name', 'Laravel') }}</b></p>
            </td>
        </tr>
        <tr>
            <td style="padding-right: 20px;padding-left: 20px;padding-top: 10px;">
                <p style="margin: 0;padding-bottom: 15px;font-size: 16px;color: #808080;">Si estás teniendo problemas para hacer clic en el enlace, copia y pega la siguiente dirección en tu buscador web: <a href="{{url('/activate/'.$code)}}" style="color: #5AB248;">{{url('/activate/'.$code)}}</a></p>
            </td>
        </tr>
    </tbody>
</table>