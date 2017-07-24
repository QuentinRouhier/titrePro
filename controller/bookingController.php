<?php

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
        $placeOfDeparture = strip_tags($_POST['placeOfDeparture']);
        $departure = explode(' -> ', $placeOfDeparture);
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
        $destination = explode(' -> ', $arrivalPoint);
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
// Instanciation de la classe users
$users = new users();

// On récupère le valeur de $_POST['placeOfDeparture']
$placeOfDeparture = $_POST['placeOfDeparture'];
// On stocke la partie suivant le '->' dans $postalCode
$placeOfDepartureArray = explode(' -> ', $placeOfDeparture);
$postalCode = $placeOfDepartureArray[1];
// On donne à l'attribut postalCode de l'objet users, la valeur de $postalCode
$users->postalCode = $postalCode;
// On utilise la méthode searchTaxiByPostalCodeDeparture() pour récupérer les chauffeurs de taxi ayant le même code postal
$taxiBooking = '';
if ($taxiBooking  = $users->searchTaxiByPostalCodeDeparture()) {
    $users->id = $_SESSION['id'] ;
    $getLocation = $users->GetCityAndPostalCode();
}