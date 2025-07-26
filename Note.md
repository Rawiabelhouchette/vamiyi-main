- mettre sweet alert en local


Prochainement:
-[ok]  creer une table qui va garder les horaires

La description d'entreprise ne marche pas


# 03/12/2023






# Annonce implementation procedure
- Create files
- Edit migration
- Edit model
- Create views
- Create livewire

- Add route
- Edit controller file
- Edit create view
- Edit livewire create 


# 12-12-2023
- [ok] Put conditions on min and max price



# Next step : 23/12/2023
- 1 page pour le detail de l'entreprise
- 1 pages pour le resultat de la recherche
- 1 page pour le detail de l'annonce

- Ajouter une photo a l'entrepise




# Liste de taches a faire
## Utilisateur public authentifié
-  [ok] Concevoir le model pour les utilisateurs publiques
- [ok] Editer l'affichage court des annonces
- [ok] Permettre la creation de compte client
- [ok] Concevoir les pages d'affichage détaillé des annonces
- [ok] Ajouter les facettes sur la page de recherche
- [ok] Ajouter les options de partage sur les annonces
- [ok] Ajouter l'option de favoris sur les annonces
- [ok] Fonction visualisation des annonces favoris
- [ok] Visualisation des mes informations
- [ok] Changement de mot de passe (par mail)
- [...] Faire une verification du compte par mail
- [ok] [notPossible] Faire des recherches sur la connexion via google account (pas possible pour le momennt apres recherche )
- [ok] Chercher si possible pourquoi les images font genre ne s'affiche pas parfois
  [raison] Donner les bonnes permission sur les dossiers
- [ok] Trouver une maniere des faire le deploiement automatique
  [solution] Via Github, avec une branche dédiée


# verifier et gerer la suppression des fichiers






Avant d'attaquer la partie détail des comptes, je pense qu'il faudrait avancer sur : 

- les facettes ( faire afficher toutes) 
- gérer la partie compte (pro et usager en respectant la maquette) 
- gérer aussi les actions ( partage, favoris etc)



# NEXT
- [ok] Ajouter l'option de type de compte lors de la creation de compte (niveau public)
- [ok] Interface de visulasation des informations
  

## 28/01/2024
  MAIL_MAILER=smtp
MAIL_HOST=mailtrap.io
MAIL_PORT=2525
MAIL_USERNAME=null
MAIL_PASSWORD=null
MAIL_ENCRYPTION=null
MAIL_FROM_ADDRESS=null
MAIL_FROM_NAME="${APP_NAME}"

a configurer dans le .env

https://aide.lws.fr/base/Email/outllook-thunderbird-iphone/Quels-ports-utiliser-pour-la-configuration-dune-adresse-email





cle site

6LfwoF8pAAAAAClgwAb7VRDlrPh-x5c0AyZ520R_

cle secrete
6LfwoF8pAAAAACHHninimPCRav9bsQawUt4bGquQ

https://developers.google.com/recaptcha/docs/v3

https://www.youtube.com/watch?v=NsFSA-MQjeY&ab_channel=CodeWithTony


# 30/01/2024
## a faire
- chercher comment afficher une image rectangle dans un carré de sorte a ce que ce soit centrer

## A continuer
- [ok] Rechecher de favoris et de commentaire
- Suppression d'un commentaire [attendre] 
- Dans Favoris le render (ne pas l'executer) 

380

download default pics


# 03/02/2024
- [ok] Faire une operation sur les stats quand on met en favoris

Home, location vehicule, le bon type n'est pas pris




- Pour la creation de compte
  - Juste creer un compte classique (usager)
  - Avoir un bouton pour passer pro


# [ok] 16/02/2024
- Essayer de mettre la page d'affichage de recheche en petit composant




- [ok] Enlever le nice-select
- [ok] Revoir la couleur des options de localisation
- [ok] on filter , changer l'url de sort a mettre correction les attributs (Le but c'est d'eviter les caracteres speciaux dans l'url)



- [ok] update url on launch using attributes


## 26/02/2024
- [ok] Lors de la copie du lien , les caracteres speciaux sont retiré , arranger cela
- [ok] Apres suppression de filtre par fois le rendu ne fait pas disparaitre l'element arranger cela



## 13/03/2024
- [ok] Pour la galerie vous vous etes basé sur le template ?
- [ok] Pour les details (equipement de vie nocture) quand il y en a plusieurs , qu'est ce qui se passe ?

## 23/03/2024
- Revoir l'affichage des etoiles sur l'affichage court des recherches
- [ok] [removed] Se pencher plus sur la ce qui vient apres les etoiles
- Ajouter l'affichage avec k pour les vues
- [ok] Afficher un message avoir avoir envoyer un commentaire
- [ok] Implementer favoris sur la page des details
- [ok] Ajouter le bouton de partage sur l'affichage des details

## 02/04/2024
- [ok] Rendre les liens cliquables dans l'affichage des informations de l'entreprise


## 11/04/2024
- AJouter attribut date de debut a annonce avec default la date de creation de l'annonce
- Ajouter aussi l'option de desactivation de l'annonce sur la liste des annonces avec une confirmatio d'action quand on clique dessus

## 13/04/2024
- Ajouter les with() au modele necessaire pour eviter les requetes supplementaires

## 14/04/2024
Etape de creation d'un nouvel abonnement
- [ok] Creer une entreprise
- [ok] Lier l'entreprise a un l'utilisateur
- [ok] Creer un abonnement
- [ok] Lier l'abonnement a l'entreprise

- [ok] Ajouter l'option d'abonnement

## 15/04/2024
- Implementer la recherche sur la page d'abonnement

## 21/04/2024
- Add a loader when loading annonce images
- Demande a MOnsieur de definir le nombre d'image a uploader et la taille max


## 24/04/2024
- Demander a Monsieur de definir les options des abonnements

## 26/04/2024
- [ok] Ajouter le mask de saisi sur le numero de telephone lors de la creation d'enreprise
- Gerer l'envoi de mail de rappel pour les abonnements


## 01/05/2024
- Desactiver le hide du modal quand l'utilisateur clique en dehors du modal lors du processus de connexion et de creation de compte


PAIEMENT
- [NN] url de notification doit être une chaine cryptee qui doit changer tout les jours
- 


NOTIFY
- [notNeed] Creer une table qui va contenir le hash de la notification
- [envoi] generer le hash a fois qu'il y a paiement et le supprimer (apres 24h)
- [NN]Verifier si le hash existe deja et que ca correspond a l'utilisateur connecte


## [ok] 11/05/2024
Make sure to generate an unique transaction id

Payment status
+ PENDING : 0
+ ERROR : -1
+ COMPLETED : 1

- Receive a post request from CinetPay
- Compare transaction_id and site_id (CinetPay - Our DB)
- Do a request on transaction to ensure that it exists
- Check the amount using the "offre->prix" value
- Check transaction status
  - OK : Make the user become a "Professionnel" and create entreprise
  - Nok : Do nothing

## 13/05/2024 : MAILING


## 18/05/2024
- [ok] Ajouter le montant a la table abonnements car les valeurs d'une offre peuvent changer

 - [ok] remove mailingservice


 - [ok] Ajouter entreprise_id dans transaction

## 23/05/2024
NN : No Need
- [NN] Ajouter le bouton de reabonnement
- Ajouter la page de reabonnement

## 24/05/2024
- Uniformiser les noms des pages (sur les pages : Abonnement / Liste)
- [ok] Cote backoffice, l'icon semble avoir diminue de taille
- [ok] Reparcourir toutes les pages
- Definir les options d'abonnement et les noms
- Detacher les recherches de la searchbox (Affichage des elements rechechés)
- Revoir le message de reinitalisation de mot de passe

## 29/05/2024
- Empecher le modal de se retirer en pleine connexion ou enregistrement



- ajouter la date de l'abonnement a la liste des abonnements