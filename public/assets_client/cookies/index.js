// Initialisation du gestionnaire d'iframe
const im = iframemanager();

im.run({
    // Définition de la fonction à exécuter lors d'un changement de service
    onChange: ({ changedServices, eventSource }) => {
        if (eventSource.type === 'click') {
            // Récupération des services acceptés par l'utilisateur et ajout des services modifiés
            const servicesToAccept = [
                ...CookieConsent.getUserPreferences().acceptedServices['analytics'],
                ...changedServices,
            ];

            // Acceptation des services pour la catégorie 'analytics'
            CookieConsent.acceptService(servicesToAccept, 'analytics');
        }
    },

    // Définition de la langue actuelle
    currLang: 'fr',

    // Suppression de la configuration des services
    services: {},
});

// Initialisation du gestionnaire de consentement des cookies
CookieConsent.run({
    guiOptions: {
        consentModal: {
            layout: 'box inline',
            position: 'bottom left',
            equalWeightButtons: false,
            flipButtons: false,
            // Ajout de l'icône de cookies
            //   logo: {
            //     src: './cookies.png', // Chemin vers l'icône de cookies
            //     alt: 'Cookies',
            //   },
        },
    },

    categories: {
        necessary: {
            readOnly: true,
            enabled: true,
        },

        ads: {},
    },

    language: {
        default: 'en',

        translations: {
            en:
            {
                "consentModal": {
                    "title": "Bienvenue, c'est l'heure des cookies ! 🍪",
                    "description": "Nous utilisons des cookies pour améliorer votre expérience. Certains sont essentiels au bon fonctionnement du site. Vous pouvez accepter ou refuser ces cookies.",
                    "acceptAllBtn": "Accepter",
                    "acceptNecessaryBtn": "Refuser",
                    "showPreferencesBtn": "",
                    "footer": ""
                }
            },
        },
    },
});
