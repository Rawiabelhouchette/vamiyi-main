<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            margin: 0;
            padding: 0;
        }

        .email-container {
            background-color: #ffffff;
            margin: 20px auto;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            max-width: 600px;
        }

        .header {
            text-align: center;
            padding-top: 20px;
        }

        .header img {
            max-width: 150px;
        }

        .content {
            text-align: left;
            font-size: 16px;
        }

        .footer {
            text-align: center;
            font-size: 14px;
            color: #888888;
            margin-top: 20px;
        }
    </style>
</head>

<body>
    <div class="header">
        <img src="{{ asset('assets/img/logo-vamiyi-by-numrod-white.png') }}" alt="Midjo Logo">
    </div>

    <div class="email-container">
        <div class="content">
            <h3>Bonjour !</h3>
            <p>Vous avez demandé à réinitialiser votre mot de passe pour votre compte {{ config('app.name') }}. Veuillez cliquer sur le bouton ci-dessous pour réinitialiser votre mot de passe :</p>
            <p style="text-align: center;">
                <a href="{{ $resetUrl }}" style="background-color: #007bff; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px;">Réinitialiser le mot de passe</a>
            </p>
            <p>Si vous n'avez pas demandé cette réinitialisation, veuillez ignorer cet email. Votre mot de passe ne sera pas modifié.</p>
            <hr>
            <p>Si vous rencontrez des difficultés pour cliquer sur le bouton "Réinitialiser", copiez et collez l'URL ci-dessous dans votre navigateur web :</p>
            <p style="word-break: break-all;">
                <a href="{{ $resetUrl }}">{{ $resetUrl }}</a>
            </p>
            <p>Merci,<br>L'équipe {{ config('app.name') }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Midjo. Tous droits réservés.</p>
        </div>
    </div>
    <div style="height: 30px;"></div>
</body>

</html>
