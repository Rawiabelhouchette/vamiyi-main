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
            <h3>Bonjour {{ $clientName }},</h3>
            <p>Nous vous remercions de vous être abonné à {{ config('app.name') }}. Votre abonnement a été activé avec succès. Voici les détails de votre abonnement :</p>
            <ul>
                <li><strong>Nom de l'offre :</strong> {{ $offerName }}</li>
                <li><strong>Durée :</strong> {{ $duration }} mois</li>
                <li><strong>Date de début :</strong> {{ $startDate }}</li>
                <li><strong>Date de fin :</strong> {{ $endDate }}</li>
            </ul>
            <p>Vous pouvez désormais profiter de tous nos services, y compris la possibilité de poster vos propres annonces et d'accéder à une multitude de fonctionnalités dédiées à la gestion de vos publications.</p>
            <p>Si vous avez des questions ou avez besoin d'assistance, n'hésitez pas à nous contacter à <a href="mailto:contact@midjo.numrod.fr">contact@midjo.numrod.fr</a> ou par téléphone au +228 93 67 35 76.</p>
            <p>Merci de votre confiance et à bientôt sur {{ config('app.name') }}.</p>
            <p>Cordialement,<br>L'équipe {{ config('app.name') }}</p>
        </div>
        <div class="footer">
            <p>&copy; {{ date('Y') }} Midjo. Tous droits réservés.</p>
        </div>
    </div>
    <div style="height: 30px;"></div>
</body>

</html>
