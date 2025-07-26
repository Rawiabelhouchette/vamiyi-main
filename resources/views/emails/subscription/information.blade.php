<!DOCTYPE html>
<html>

<head>
    <title>Information sur un abonnement à {{ config('app.name') }}</title>
</head>

<body>
    <p>Bonjour Monsieur</p>

    <p>Un client vient de s'abonner à {{ config('app.name') }}. Voici les détails de son abonnement :</p>

    <p>
        <strong>Nom du client</strong> : {{ $clientName }}<br>
        <strong>Nom de l'offre</strong> : {{ $offerName }}<br>
        <strong>Montant</strong> : {{ $amount }} FCFA<br>
        <strong>Durée</strong> : {{ $duration }} mois<br>
        <strong>Date de début</strong> : {{ $startDate }}<br>
        <strong>Date de fin</strong> : {{ $endDate }}
    </p>
</body>

</html>
