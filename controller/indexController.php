<?php
// Si verifEmail et verifPassword sont envoyer en post par ajax et qu'il sont set (fixer)
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
        //Instanciation de la classe users pour la connexion (pour la value dans la modal)
        $users = new users();
    }
// si logOut est isset tu deconnect la personne 
    if (isset($_GET['logOut'])) {
        //Détruit toutes les variables d'une session
        session_unset();
        //Détruit la session
        session_destroy();
        //redirection vers l'accueil
        header('location: /accueil');
        //On s'assure que la suite du code ne soit pas exécutée une fois la redirection effectuée.
        exit;
    }
// Les message de reussite de l'inscription et de la modification
    $message = '';
    //si r et passer en parametre la variable $message contient un message
    if (isset($_GET['r'])) {
        $message = REGISTER_SUCCESS_SEND;
    }
    //si d et passer en parametre la variable $message contient un message
    if (isset($_GET['d'])) {
        $message = DELETE_SUCCESS_SEND;
    }
    //si u et passer en parametre la variable $message contient un message
    if (isset($_GET['u'])) {
        $message = REGISTER_SUCCESS_UPDATE;
    }


    // la reservation on regarde ce qui est donner en post (ajax)
    if (isset($_POST['searchPlaceOfDeparture'])) {
        //Tu inclus les fichier dans le bonne ordre
        include_once '../configuration.php';
        include_once '../class/database.php';
        include_once '../model/location.php';
        include_once '../model/booking.php';
        //Instanciation de la classe booking et location
        $booking = new booking();
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
        include_once '../model/booking.php';
        //Instanciation de la classe booking et location
        $booking = new booking();
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
            $regexMax100Characters = '/^([a-z0-9àéèëêù\'ïîâäöôç\- ,.>]){2,100}$/i';
            $regexcity = '/^([A-Z ]){2,100}( -> )([0-9]){5}$/';
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['placeOfDeparture'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $placeOfDeparture = strip_tags($_POST['placeOfDeparture']);
                //Si la regex ne match pas
                if (!preg_match($regexcity, $placeOfDeparture)) {
                    //Tu mets une erreur
                    $errorList['placeOfDeparture'] = BOOKING_ERROR_PLACE_DEPARTURE;
                } else {
                    // si il n'y a pas d'erreur tu mets la variable dans la variable de session
                    $_SESSION['placeOfDeparture'] = $placeOfDeparture;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['placeOfDeparture'] = BOOKING_EMPTY_VALUE;
            }
            if (!empty($_POST['addressPlaceOfDeparture'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $addressPlaceOfDeparture = strip_tags($_POST['addressPlaceOfDeparture']);
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $addressPlaceOfDeparture)) {
                    //Tu mets une erreur
                    $errorList['addressPlaceOfDeparture'] = BOOKING_ERROR_ADDRESS_PLACE_DEPARTURE;
                } else {
                    // si il n'y a pas d'erreur tu mets la variable dans la variable de session
                    $_SESSION['addressPlaceOfDeparture'] = $addressPlaceOfDeparture;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['addressPlaceOfDeparture'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['arrivalPoint'])) {
                // tu passe en POST la value qui es de dans pour le placer dans une variable
                $arrivalPoint = strip_tags($_POST['arrivalPoint']);
                if (!preg_match($regexcity, $arrivalPoint)) {
                    //Tu mets une erreur
                    $errorList['arrivalPoint'] = BOOKING_ERROR_ARRIVAL_POINT;
                } else {
                    // si il n'y a pas d'erreur tu mets la variable dans la variable de session
                    $_SESSION['arrivalPoint'] = $arrivalPoint;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['arrivalPoint'] = BOOKING_EMPTY_VALUE;
            }
            if (!empty($_POST['addressArrivalPoint'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $addressArrivalPoint = strip_tags($_POST['addressArrivalPoint']);
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $addressArrivalPoint)) {
                    //Tu mets une erreur
                    $errorList['addressArrivalPoint'] = BOOKING_ERROR_ARRIVAL_POINT;
                } else {
                    // si il n'y a pas d'erreur tu mets la variable dans la variable de session
                    $_SESSION['addressArrivalPoint'] = $addressArrivalPoint;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['addressArrivalPoint'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['dateOfDepartur'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $dateOfDepartur = strip_tags($_POST['dateOfDepartur']);
                // Puis le mets dans la variable de session
                $_SESSION['dateOfDepartur'] = $dateOfDepartur;
                //Sinon tu mets une erreur
            } else {
                $errorList['dateOfDepartur'] = BOOKING_EMPTY_VALUE;
            }
            //si ce qui est envoyer en post n'est pas vide tu passe a l'etape suivante
            if (!empty($_POST['timeOfArrival'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $timeOfArrival = strip_tags($_POST['timeOfArrival']);
                // Puis le mets dans la variable de session
                $_SESSION['timeOfArrival'] = $timeOfArrival;
                //Sinon tu mets une erreur
            } else {
                $errorList['timeOfArrival'] = BOOKING_EMPTY_VALUE;
            }
            //si il y a une ou plus tu mets un message d'erreur dans la varialbe $message
            if (!count($errorList) == 0) {
                $message = BOOKING_ERROR;
                //Sinon tu redirige vers la page reservation
            } else {
                header('location: /reservation');
                //On s'assure que la suite du code ne soit pas exécutée une fois la redirection effectuée.
                exit;
            }
        }
    }
}