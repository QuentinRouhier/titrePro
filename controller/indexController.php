<?php

// Si verifEmail et verifPassword sont fixer(isset) (ajax) 
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
    //password_verify Vérifie que le  mot de passe correspond au hachage .
    $isOk = password_verify($password, $users->password);
    // si la mot de passe est identique
    if ($isOk) {
        //tu prend l'email indiquer
        $_SESSION['email'] = $users->email;
        // Puis tu fais appel a la methode getUsers() pour remplir les variables de  sessions 
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
    //si il n'y a personne de connecter
    if (isset($_SESSION)) {
        //Instanciation de la classe users pour la connexion (c'est juste pour la value si il ce trompe)
        $users = new users();
    }
// si logOut est isset tu deconnect la personne 
    if (isset($_POST['logOut'])) {
        session_unset();
        session_destroy();
    }
// Les message de reussite de l'inscription et de la modification
    $message = '';
    //si message_reussite et passer en parametre la variable $message contient un message
    if (isset($_GET['message_reussite'])) {
        $message = REGISTER_SUCCESS_SEND;
    }
    //si modification_reussite et passer en parametre la variable $message contient un message
    if (isset($_GET['modification_reussite'])) {
        $message = REGISTER_SUCCESS_UPDATE;
    }


    // la reservation on regarde ce qui est donner en post (ajax)
    if (isset($_POST['searchPlaceOfDeparture'])) {
        //Tu inclus les fichier dans le bonne ordre
        include_once '../configuration.php';
        include_once '../class/database.php';
        include_once '../model/location.php';
        //Instanciation de la classe location
        $location = new location();
        //Tu ajoute ce qu'il y a dans le post dans l'attribu city
        $location->city = $_POST['searchPlaceOfDeparture'];
        //tu execute la methode getLocation() dans la variable $result
        $result = $location->getLocation();
        //tu envoie la reponse en json_encode qui est recuperer dans l'ajax
        echo json_encode(array('response' => $result));
    } else if (isset($_POST['searchArrivalPoint'])) {
        //Tu inclus les fichier dans le bonne ordre
        include_once '../configuration.php';
        include_once '../class/database.php';
        include_once '../model/location.php';
        //Instanciation de la classe location
        $location = new location();
        //Tu ajoute ce qu'il y a dans le post dans l'attribu city
        $location->city = $_POST['searchArrivalPoint'];
        //tu execute la methode getLocation()
        $result = $location->getLocation();
        //tu envoie la reponse en json_encode qui est recuperer dans l'ajax
        echo json_encode(array('response' => $result));
    } else {
        // instantiation de la class booking
        $booking = new booking();
        // cration d'un tableau errorList utiliser tout au long du processuce de reservation 
        $errorList = array();

        if (isset($_POST['booking'])) {
            // on utilise la variable de session pour ajouter l'id de lutilisateur dans l'attribu id_taxi_users
            $booking->id_taxi_users = $_SESSION['id'];
            $regexMax100Characters = '/^([a-z0-9àéèëêù\'ïîâäöôç\- ,.>]){2,100}$/i';
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['placeOfDeparture'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $placeOfDeparture = strip_tags($_POST['searchArrivalPoint']);
                $departure = explode(' -> ',$placeOfDeparture);
                $booking->placeOfDeparture = $departure[0];
                $booking->postalCodeDeparture = $departure[1];
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $booking->placeOfDeparture)) {
                    //Tu mets une erreur
                    $errorList['placeOfDeparture'] = BOOKING_ERROR_PLACE_DEPARTURE;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['placeOfDeparture'] = BOOKING_EMPTY_VALUE;
            }
            if (!empty($_POST['addressPlaceOfDeparture'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $booking->addressPlaceOfDeparture = strip_tags($_POST['addressPlaceOfDeparture']);
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $booking->addressPlaceOfDeparture)) {
                    //Tu mets une erreur
                    $errorList['addressPlaceOfDeparture'] = BOOKING_ERROR_ADDRESS_PLACE_DEPARTURE;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['addressPlaceOfDeparture'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['arrivalPoint'])) {
                // tu passe en POST la value qui es de dans pour le placer dans une variable
                $arrivalPoint = strip_tags($_POST['arrivalPoint']);
                $destination = explode(' -> ',$arrivalPoint);
                $booking->arrivalPoint = $destination[0];
                $booking->postalCodeArrivalPoint = $destination[1];
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $booking->arrivalPoint)) {
                    //Tu mets une erreur
                    $errorList['arrivalPoint'] = BOOKING_ERROR_ARRIVAL_POINT;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['arrivalPoint'] = BOOKING_EMPTY_VALUE;
            }
            if (!empty($_POST['addressArrivalPoint'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $booking->addressArrivalPoint = strip_tags($_POST['addressArrivalPoint']);
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $booking->addressArrivalPoint)) {
                    //Tu mets une erreur
                    $errorList['addressArrivalPoint'] = BOOKING_ERROR_ARRIVAL_POINT;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['addressArrivalPoint'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['dateOfDepartur'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $booking->dateOfDepartur = strip_tags($_POST['dateOfDepartur']);
                //Sinon tu mets une erreur
            } else {
                $errorList['dateOfDepartur'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
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
                }
            }
        }
    }
}