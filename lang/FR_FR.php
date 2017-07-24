<?php
/*
 * Déclaration des constantes de langue 
 */

/**
 * Texte de la page register
 */
define('REGISTER_TITLE','Inscription d\'un nouvel utilisateur');
define('REGISTER_GROUP','Vous êtes : *');
define('REGISTER_SOCIETY','Votre société : *');
define('REGISTER_DESCRIBE_SOCIETY','Décrire votre société : *');
define('REGISTER_LASTNAME','Nom : *');
define('REGISTER_FIRSTNAME','Prénom : *');
define('REGISTER_BIRTHDATE','Date de naissance : *');
define('REGISTER_ADDRESS','Adresse : *');
define('REGISTER_POSTALCODE','Code postal : *');
define('REGISTER_CITY','Ville/Village : *');
define('REGISTER_FIRSTPHONENUMBER','Numéro de téléphone : *');
define('REGISTER_SECONDPHONENUMBER','Second numéro de téléphone : ');
define('REGISTER_PLACE','Ville : *');
define('REGISTER_EMAIL','Adresse mail : *');
define('REGISTER_PASSWORD','Mot de passe : *');
define('REGISTER_CONFIRMPASSWORD','Répétez votre mot de passe : *');

define('REGISTER_REGISTER','Enregistrer');

define('REGISTER_ERROR_SOCIETY','La société que vous avez renseigné est invalide. Veuillez n\utiliser que des chiffres et des lettres ne depasent pas 100 caractères et moins de 3.');
define('REGISTER_ERROR_DESCRIBESOCIETY','La déscription que vous avez renseigné est invalide. Veuillez n\utiliser que des chiffres et des lettres ne depasent pas 150 caractères et moins de 3.');
define('REGISTER_ERROR_LASTNAME','Le nom que vous avez renseigné est invalide.Veuillez n\'utiliser que des lettres');
define('REGISTER_ERROR_FIRSTNAME','Le prénom que vous avez renseigné est invalide. Veuillez n\'utiliser que des lettre');
define('REGISTER_ERROR_BIRTHDATE','La date de naissance que vous avez renseignée est invalide. Veuillez respecter jj/mm/AAAA');
define('REGISTER_ERROR_ADDRESS','L\'adresse que vous avez renseignée est invalide');
define('REGISTER_DUPLICATE_ADDRESS','L\'adresse que vous avez renseignée est déjà enregistré');
define('REGISTER_ERROR_POSTALCODE','Le code postal que vous avez renseigné est invalide. Il doit comporter 5 chiffres ou au moins 4 chiffres');
define('REGISTER_ERROR_PHONENUMBER','Le numéro de téléphone que vous avez renseigné est invalide. Veuillez respecter 0X.XX.XX.XX.XX. Vous ne pouvez pas commencer par 00.XX.XX.XX.XX.');
define('REGISTER_ERROR_SERVICENAME','Wrong!');
define('REGISTER_ERROR_SEND','Erreur durant l\'ajout de l\'utilisateur');
define('REGISTER_ERROR_UPDATE','Erreur durant la modification de l\'utilisateur');
define('REGISTER_SUCCESS_SEND','L\'utilisateur a bien été ajouté');
define('REGISTER_SUCCESS_UPDATE','L\'utilisateur a bien été modifié');
define('REGISTER_EMPTY_VALUE','Veuillez remplir le champ');
define('REGISTER_RETURN','Retour');
define('REGISTER_ERROR','Erreur!!!');
define('REGISTER_SUCCESS_MODIFY','L\'utilisateur a bien été modifié');
define('REGISTER_ERROR_MODIFY','Erreur durant la modification');
define('REGISTER_ERROR_PASSWORD','Vos mots de passe de sont pas identique');


define('USER_DISCONNECT','Bonjour, et bienvenu(e) sur Reservez-un-taxi.fr, veuillez vous authentifier pour poursuivre.');
define('USER_CONNECT','Réservez votre taxi.');

define('DELETE','Supprimer');
define('UPDATE','Modifier');

define('SIGN_UP','Inscription');
define('SIGN_IN','Connexion');
define('LOG_OUT','Déconnexion');
define('CLOSE','Fermer');
define('MY_BOOKING','Mes réservation');
define('EDIT','Profil');

define('DEPARTURE','Départ : *');
define('ARRIVAL','Arrivé : *');
define('TIME_ARRIVAL','Heure d\'arrivé : *');
define('DATE_DEPARTURE','Date : *');
define('BOOKING','Réservation');

define('LOGINE','Les données saisi sont incorrect');

define('BOOKING_EMPTY_VALUE','Veuillez remplir le champ');
define('BOOKING_ERROR_PLACE_DEPARTURE','L\'adresse doit comporter au moins 2 lettres et maximum 100');
define('BOOKING_ERROR_ARRIVAL_POINT','L\'adresse doit comporter au moins 2 lettres et maximum 100');
define('BOOKING_ERROR_ADDRESS_PLACE_DEPARTURE','L\'adresse doit comporter au moins 2 lettres et maximum 100');
define('BOOKING_ERROR','Erreur durant la réservation.');

define('ADDRESS_ARRIVAL','Adresse d\'arriver : *');
define('ADDRESS_DEPARTURE','Adresse de depart : *');

define('LAST_NAME','Nom :');
define('FIRST_NAME','Prénom :');
define('POSTAL_CODE','Code postal :');
define('CITY','Ville :');
define('FIRST_PHONE_NUMBER','Premier numéro de téléphone :');
define('SECOND_PHONE_NUMBER','Second numéro de téléphone :');
define('ADDRESS','Adresse:');
define('SOCIETY','Société :');
define('DESCRIBE_SOCIETY','Déscription de la société : ');
define('EMAIL','Adresse Mail :');