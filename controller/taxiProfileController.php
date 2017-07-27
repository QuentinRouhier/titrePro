<?php

//instantiation de la class users()
$users = new users();
//recupere la valeur de l'input de type hidden pour connaitre l'id tu taxi
$users->id = intval($_SESSION['idTaxi']);
//Affiche les information dans un foreach
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();
$booking = new booking();
$message = '';
if (isset($_POST['chooseTaxi'])) {
    $placeOfDeparture = $_SESSION['placeOfDeparture'];
    $departure = explode(' -> ', $placeOfDeparture);
    $booking->placeOfDeparture = $departure[0];
    $booking->postalCodeDeparture = $departure[1];

    $booking->addressPlaceOfDeparture = $_SESSION['addressPlaceOfDeparture'];
    $arrivalPoint = $_SESSION['arrivalPoint'];
    $destination = explode(' -> ', $arrivalPoint);
    $booking->arrivalPoint = $destination[0];
    $booking->postalCodeArrivalPoint = $destination[1];
    $booking->addressArrivalPoint = $_SESSION['addressArrivalPoint'];
    $booking->dateOfDepartur = $_SESSION['dateOfDepartur'];
    $booking->timeOfArrival = $_SESSION['timeOfArrival'];
    $booking->id_taxi_users = intval($_SESSION['id']);
    $booking->id_taxi_booked = intval($_SESSION['idTaxi']);
    if (!$booking->addBooking()) {
        //Tu affiche une erreur
        $message = BOOKING_ERROR;
        //Sinon tu redirige la page sur l'index
    } else {
        $_SESSION['placeOfDeparture'] = '';
        $_SESSION['addressPlaceOfDeparture'] = '';
        $_SESSION['arrivalPoint'] = '';
        $_SESSION['addressArrivalPoint'] = '';
        $_SESSION['dateOfDepartur'] = '';
        $_SESSION['timeOfArrival'] = '';
        $_SESSION['idTaxi'] = '';
        $_SESSION['placeOfDeparture'] = '';
        header('location: /accueil');
        exit;
    }
}
    $comments = new comments();
    $comments->id = intval($_SESSION['idTaxi']);
    $getComment = $comments->getComment();