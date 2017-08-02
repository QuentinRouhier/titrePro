<?php
//instantiation de la class users()
$users = new users();
//recupere la valeur de l'input de type hidden pour connaitre l'id tu taxi
$users->id = intval($_SESSION['idTaxi']);
//Affiche les information du taxi dans un foreach
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();
//instantiation de la class booking()
$booking = new booking();
$message = '';
// Quand chooseTaxi est isset 
if (isset($_POST['chooseTaxi'])) {
    // On met la valeur de la variable de session dans la variable $placeOfDeparture
    $placeOfDeparture = $_SESSION['placeOfDeparture'];
    // On stock ce qui a avant et apres le '->' ceci fait un tableau, on la stock dans $departure
    $departure = explode(' -> ', $placeOfDeparture);
    // On donne à l'attribut placeOfDeparture de l'objet booking, la valeur de la premiere ligne du tableau
    $booking->placeOfDeparture = $departure[0];
    // On donne à l'attribut postalCodeDeparture de l'objet booking, la valeur de la deuxieme ligne du tableau
    $booking->postalCodeDeparture = $departure[1];
    // On donne à l'attribut addressPlaceOfDeparture de l'objet booking, la valeur 
    // de la variable de session addressPlaceOfDeparture
    $booking->addressPlaceOfDeparture = $_SESSION['addressPlaceOfDeparture'];
    // On met la valeur de la variable de session dans la variable $arrivalPoint
    $arrivalPoint = $_SESSION['arrivalPoint'];
    // On stock ce qui a avant et apres le '->' ceci fait un tableau, on la stock dans $destination
    $destination = explode(' -> ', $arrivalPoint);
    // On donne à l'attribut arrivalPoint de l'objet booking, la valeur de la premiere ligne du tableau
    $booking->arrivalPoint = $destination[0];
    // On donne à l'attribut postalCodeArrivalPoint de l'objet booking, la valeur de la deuxieme ligne du tableau
    $booking->postalCodeArrivalPoint = $destination[1];
    // On donne à l'attribut addressArrivalPoint de l'objet booking, la valeur 
    // de la variable de session addressArrivalPoint
    $booking->addressArrivalPoint = $_SESSION['addressArrivalPoint'];
    // On donne à l'attribut dateOfDepartur de l'objet booking, la valeur 
    // de la variable de session dateOfDepartur
    $booking->dateOfDepartur = $_SESSION['dateOfDepartur'];
    // On donne à l'attribut timeOfArrival de l'objet booking, la valeur 
    // de la variable de session timeOfArrival
    $booking->timeOfArrival = $_SESSION['timeOfArrival'];
    // On donne à l'attribut id_taxi_users de l'objet booking, la valeur 
    // de la variable de session id
    $booking->id_taxi_users = intval($_SESSION['id']);
    // On donne à l'attribut id_taxi_booked de l'objet booking, la valeur 
    // de la variable de session idTaxi
    $booking->id_taxi_booked = intval($_SESSION['idTaxi']);
    // si la methode ne marche pas
    if (!$booking->addBooking()) {
        //Tu affiche une erreur
        $message = BOOKING_ERROR;
        //Sinon tu ajoute et tu vide les variable de session
    } else {
        $_SESSION['placeOfDeparture'] = '';
        $_SESSION['addressPlaceOfDeparture'] = '';
        $_SESSION['arrivalPoint'] = '';
        $_SESSION['addressArrivalPoint'] = '';
        $_SESSION['dateOfDepartur'] = '';
        $_SESSION['timeOfArrival'] = '';
        $_SESSION['idTaxi'] = '';
        $_SESSION['placeOfDeparture'] = '';
        // puis redirige vers l'accueil
        header('location: /accueil');
        //On s'assure que la suite du code ne soit pas exécutée une fois la redirection effectuée.
        exit;
    }
}
//instantiation de la class comments()
$comments = new comments();
//Puis on donne à l'attribut id de l'objet comments, la valeur de la varriable de session idTaxi
$comments->id = intval($_SESSION['idTaxi']);
//On stock la methode getComment pour afficher les commentaires dans la variable $getComment
//afin d'afficher dans un forech.
$getComment = $comments->getComment();