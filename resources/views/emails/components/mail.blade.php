<!doctype html>
<html lang="en" xmlns="http://www.w3.org/1999/xhtml" xmlns:v="urn:schemas-microsoft-com:vml" xmlns:o="urn:schemas-microsoft-com:office:office">

<head>
    <title> Midjo </title>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style type="text/css">
        #outlook a {
            padding: 0;
        }

        body {
            margin: 0;
            padding: 0;
            -webkit-text-size-adjust: 100%;
            -ms-text-size-adjust: 100%;
        }

        table,
        td {
            border-collapse: collapse;
            mso-table-lspace: 0pt;
            mso-table-rspace: 0pt;
        }

        img {
            border: 0;
            height: auto;
            line-height: 100%;
            outline: none;
            text-decoration: none;
            -ms-interpolation-mode: bicubic;
        }

        p {
            display: block;
            margin: 13px 0;
        }
    </style>
    <style type="text/css">
        .mj-outlook-group-fix {
            width: 100% !important;
        }
    </style>
    <link type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:100,300,400,700" rel="stylesheet">
    <style type="text/css">
        @import url(https://fonts.googleapis.com/css?family=Roboto:100,300,400,700);
    </style>
    <style type="text/css">
        @media only screen and (min-width:480px) {
            .mj-column-per-100 {
                width: 100% !important;
                max-width: 100%;
            }
        }
    </style>
    <style type="text/css">
        @media only screen and (max-width:480px) {
            table.mj-full-width-mobile {
                width: 100% !important;
            }

            td.mj-full-width-mobile {
                width: auto !important;
            }
        }
    </style>
    <style type="text/css">
        a,
        span,
        td,
        th {
            -webkit-font-smoothing: antialiased !important;
            -moz-osx-font-smoothing: grayscale !important;
        }
    </style>
    <style>
        .header {
            text-align: center;
            padding-top: 20px;
            padding-bottom: 20px;
        }

        .header img {
            max-width: 150px;
            max-height: 70px;
        }
    </style>
</head>

<body style="background-color:#f3f3f5;">
    <div class="header">
        <img src="https://midjo.numrod.fr/assets/img/logo-vamiyi-by-numrod-small.png" alt="Midjo Logo">
        {{-- <img src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" alt="Midjo Logo"> --}}
    </div>
    <div style="background-color:#f3f3f5;">
        <div style="background:#cfd7e1;background-color:#cfd7e1;margin:0px auto;border-radius:4px 4px 0 0;max-width:600px;">
            <table role="presentation" style="background:#cfd7e1;background-color:#cfd7e1;width:100%;border-radius:4px 4px 0 0;" align="center" border="0" cellpadding="0" cellspacing="0">
                <tbody>
                    <tr>
                        <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                            <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                <table role="presentation" style="vertical-align:top;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                    <tr>
                                        <td style="font-size:0px;padding:10px 25px;word-break:break-word;" align="left">
                                            <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:24px;font-weight:400;line-height:30px;text-align:left;color:black;">
                                                <h1 style="margin: 0; font-size: 24px; line-height: normal; font-weight: normal;">
                                                    Bonjour {{ $firstName }},
                                                </h1>
                                            </div>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td style="font-size:0px;padding:10px 25px;word-break:break-word;" align="left">
                                            <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:black;">
                                                <p style="margin-bottom: 0;">
                                                    Nous vous confirmons que votre inscription sur <a href="{{ config('app.url') }}"><strong>{{ config('app.name') }}</strong></a> a été réalisée avec succès.
                                                </p>
                                                <p>
                                                    Vos informations de connexion :
                                                <ul>
                                                    <li><strong>Nom d'utilisateur :</strong> {{ $username }}</li>
                                                    <li><strong>Adresse e-mail :</strong> {{ $email }}</li>
                                                </ul>
                                                </p>
                                                <p>
                                                    Accédez à votre compte ici ici : <a href="{{ route('login') }}" style="color: #2e58ff; text-decoration: none;">Connexion</a>
                                                </p>
                                                <p>
                                                    Pour toute question ou assistance, veuillez nous contacter par
                                                    <a href="https://wa.me/{{ str_replace(' ', '', env('APP_PHONE')) }}" target="_blank">
                                                        WhatsApp
                                                        {{-- <img src="https://midjo.numrod.fr/assets/img/logo-vamiyi-by-numrod-small.png" alt="Contactez-nous via WhatsApp" width="100" height="100"> --}}
                                                        {{-- <img src="{{ asset('assets/img/whatsapp_logo.png') }}" alt="Contactez-nous via WhatsApp"> --}}
                                                    </a>.
                                                </p>
                                                <p>
                                                    Bienvenue parmi nous !
                                                </p>
                                                <p>Cordialement,</p>

                                                <p>L'équipe {{ config('app.name') }}</p>
                                            </div>
                                        </td>
                                    </tr>
                                    {{-- <tr>
                                        <td style="font-size:0px;padding:10px 25px;word-break:break-word;" align="left">
                                            <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:left;color:#ffffff;">
                                                <p style="margin-bottom: 0;">If you have any questions simply reply to this email and we would be more than happy to reply. :)</p>
                                            </div>
                                        </td>
                                    </tr> --}}
                                </table>
                            </div>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>

        <table
               class="" style="width:600px;" align="center" border="0" cellpadding="0" cellspacing="0" width="600">
            <tr>
                <td style="line-height:0px;font-size:0px;mso-line-height-rule:exactly;">
                    <div style="background:#ffffff;background-color:#ffffff;margin:0px auto;border-radius:0 0 4px 4px;max-width:600px;">
                        <table role="presentation" style="background:#ffffff;background-color:#ffffff;width:100%;border-radius:0 0 4px 4px;" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                                        <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                            <table role="presentation" style="vertical-align:top;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td style="font-size:0px;padding:10px 25px;word-break:break-word;" align="center">
                                                        <div style="font-family:Roboto, Helvetica, Arial, sans-serif;font-size:14px;font-weight:400;line-height:20px;text-align:center;color:#93999f;">© {{ date('Y') }} {{ config('app.name') }}, Tous droits réservés <br> Email: <a class="footer-link" href="mailto:{{ env('APP_EMAIL') }}" style="color: #2e58ff; text-decoration: none;">{{ env('APP_EMAIL') }}</a> <br> Web: <a class="footer-link" href="{{ config('app.url') }}" style="color: #2e58ff; text-decoration: none;">{{ config('app.url') }}</a></div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <div style="margin:0px auto;max-width:600px;">
                        <table role="presentation" style="width:100%;" align="center" border="0" cellpadding="0" cellspacing="0">
                            <tbody>
                                <tr>
                                    <td style="direction:ltr;font-size:0px;padding:20px 0;text-align:center;">
                                        <div class="mj-column-per-100 mj-outlook-group-fix" style="font-size:0px;text-align:left;direction:ltr;display:inline-block;vertical-align:top;width:100%;">
                                            <table role="presentation" style="vertical-align:top;" border="0" cellpadding="0" cellspacing="0" width="100%">
                                                <tr>
                                                    <td style="font-size:0px;word-break:break-word;">
                                                        <div style="height:1px;"> &nbsp; </div>
                                                    </td>
                                                </tr>
                                            </table>
                                        </div>
                                    </td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </td>
            </tr>
        </table>
    </div>
</body>

</html>
