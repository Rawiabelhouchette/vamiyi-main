<!DOCTYPE html>
<html>

<head>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <script src="https://cdn.cinetpay.com/seamless/main.js"></script>
    {{-- jqwuery --}}
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <style>
        .sdk {
            display: block;
            position: absolute;
            background-position: center;
            text-align: center;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%);
        }
    </style>
    <script>
        // checkout();
        $(document).ready(async function() {
            function checkout() {
                CinetPay.setConfig({
                    apikey: '{{ $apikey }}', //   YOUR APIKEY
                    site_id: '{{ $site_id }}', //YOUR_SITE_ID
                    notify_url: 'http://mondomaine.com/notify/',
                    mode: 'PROD'
                });
                CinetPay.getCheckout({
                    transaction_id: Math.floor(Math.random() * 100000000).toString(), // YOUR TRANSACTION ID
                    amount: {{ $montant }},
                    currency: 'XOF',
                    // channels: 'CREDIT_CARD',
                    channels: 'MOBILE_MONEY,CREDIT_CARD',
                    // channels: 'ALL',
                    description: 'Test de paiement',
                    //Fournir ces variables pour le paiements par carte bancaire
                    customer_name: "Joe", //Le nom du client
                    customer_surname: "Down", //Le prenom du client
                    customer_email: "down@test.com", //l'email du client
                    customer_phone_number: "088767611", //l'email du client
                    customer_address: "BP 0024", //addresse du client
                    customer_city: "Antananarivo", // La ville du client
                    customer_country: "TG", // le code ISO du pays
                    customer_state: "TG", // le code ISO l'état
                    customer_zip_code: "06510", // code postal
                });
                CinetPay.waitResponse(function(data) {
                    if (data.status == "REFUSED") {
                        alert(data);
                        console.log(data);
                        if (alert("Votre paiement a échoué")) {
                            window.location.reload();
                        }
                    } else if (data.status == "ACCEPTED") {
                        if (alert("Votre paiement a été effectué avec succès")) {
                            window.location.reload();
                        }
                    }
                });
                CinetPay.onError(function(data) {
                    console.log(data);
                });
            }
            await checkout();



            // wait 2 second
            //         setTimeout(function() {
            //             console.log('++++++++++++');

            //             console.log($('#desk-action').html());
            //             // $('#desk-action').append('<button type="button" class="btn btn-next btn-block" ">Annuler</button>');
            //             var element = document.getElementById('desk-action');
            // if (element) {
            //     console.log(element.innerHTML);
            //     // element.innerHTML += '<button type="button" class="btn btn-next btn-block">Annuler</button>';
            // } else {
            //     console.log('Element #desk-action not found');
            // }
            //         }, 5000);
            //         // $('.desk-action.p-3').append('<button type="submit" class="btn btn-next btn-block" id="del">Payer 15 000 XOF</button>');
        });
    </script>
</head>

<body>
    </head>

    <body>
        <div style="
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-image: url('https://docs.cinetpay.com/accueil/assets/images/logo-cinetpay.webp');
            background-repeat: no-repeat;
            background-position: center;
            background-size: contain;
        ">
            {{-- <div class="sdk"></div> --}}
        </div>
    </body>

</html>
