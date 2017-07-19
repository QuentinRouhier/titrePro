<?php

// Si verifEmail et verifPassword sont isset 
if (isset($_POST['verifEmail']) && isset($_POST['verifPassword'])) {
    // Tu démares la session
    session_start();
    //Tu inclus les bon fichier dans le bon ordre
    include_once '../configuration.php';
    include_once '../lang/FR_FR.php';
    include_once '../class/database.php';
    include_once '../model/users.php';
    //Instanciation de la classe users
    $users = new users();
    // Si la variable $error est false est qu'il n'y a pas d'erreur
    $error = false;
    // On récupère l'email et le mot de passe envoyé 
    $users->email = strip_tags($_POST['verifEmail']);
    $password = strip_tags($_POST['verifPassword']);
    // Avec la methode getHashByUser on regarde si le mots de passe correspond a celui de l'email
    $users->getHashByUser();
    //password_verify Vérifie qu'un mot de passe correspond à un hachage .
    $isOk = password_verify($password, $users->password);
    // si la mot de passe est identique
    if ($isOk) {
        //tu prend l'email indiquer
        $_SESSION['email'] = $users->email;
        // Puis tu fais appel a la methode getUsers() pour hydrater et donc remplir les sessions
        $users->getUsers();
        $_SESSION['id'] = $users->id;
        $_SESSION['lastName'] = $users->lastName;
        $_SESSION['lastName'] = $users->lastName;
        $_SESSION['firstName'] = $users->firstName;
        $_SESSION['firstPhoneNumber'] = $users->firstPhoneNumber;
        $_SESSION['secondPhoneNumber'] = $users->secondPhoneNumber;
        $_SESSION['birthDate'] = $users->birthDate;
        $_SESSION['address'] = $users->address;
        $_SESSION['society'] = $users->society;
        $_SESSION['describeSociety'] = $users->describeSociety;
        $_SESSION['id_taxi_group'] = $users->id_taxi_group;
        $_SESSION['id_taxi_location'] = $users->id_taxi_location;
    } else {
        //sinon il y a une erreur
        $error = true;
    }
    //envoie l'erreur à login.js
    echo json_encode(array('error' => $error));
} else {
// Les message de reussite de l'inscription et de la modification
    $message = '';
    if (isset($_GET['message_reussite'])) {
        $message = REGISTER_SUCCESS_SEND;
    }
    if (isset($_GET['modification_reussite'])) {
        $message = REGISTER_SUCCESS_UPDATE;
    }
// la deconnexion.
    $users = new users();
    if (isset($_POST['logOut'])) {
        session_unset();
        session_destroy();
    }
    $booking = new booking();
    $errorList = array();
    if (isset($_POST['booking'])) {
        $booking->id_taxi_users = $_SESSION['id'];
        $regexMax100Characters = '/^([a-z0-9àéèëêù\'ïîâäöôç\- ]){2,100}$/i';
        if (!empty($_POST['placeOfDeparture'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $booking->placeOfDeparture = strip_tags($_POST['placeOfDeparture']);
            //Si la regex ne match pas
            if (!preg_match($regexMax100Characters, $booking->placeOfDeparture)) {
                //Tu mets une erreur
                $errorList['placeOfDeparture'] = BOOKING_ERROR_PLACE_DEPARTURE;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['placeOfDeparture'] = BOOKING_EMPTY_VALUE;
        }
        if (!empty($_POST['arrivalPoint'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $booking->arrivalPoint = strip_tags($_POST['arrivalPoint']);
            //Si la regex ne match pas
            if (!preg_match($regexMax100Characters, $booking->arrivalPoint)) {
                //Tu mets une erreur
                $errorList['arrivalPoint'] = BOOKING_ERROR_ARRIVAL_POINT;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['placeOfDeparture'] = BOOKING_EMPTY_VALUE;
        }
        if (!empty($_POST['dateOfDepartur'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $booking->dateOfDepartur = strip_tags($_POST['dateOfDepartur']);
            //Sinon tu mets une erreur
        } else {
            $errorList['dateOfDepartur'] = BOOKING_EMPTY_VALUE;
        }
        if (!empty($_POST['timeOfArrival'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $booking->timeOfArrival = strip_tags($_POST['timeOfArrival']);
            //Sinon tu mets une erreur
        } else {
            $errorList['timeOfArrival'] = BOOKING_EMPTY_VALUE;
        }
        if (count($errorList) == 0) {
            //Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$booking->addBooking()) {
                //Tu affiche une erreur
                $message = BOOKING_ERROR;
                //Sinon tu redirige la page sur l'index
            } else
                header('Location: booking.php');
            exit;
        }
    }
}