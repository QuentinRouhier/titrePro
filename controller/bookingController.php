<?php

// Instanciation de la classe users
$users = new users();
// On récupère le valeur de par la session $_SESSION['placeOfDeparture']
$placeOfDeparture = $_SESSION['placeOfDeparture'];
// On stocke la partie suivant le '->' dans $postalCode
$placeOfDepartureArray = explode(' -> ', $placeOfDeparture);
$postalCode = $placeOfDepartureArray[1];
// On donne à l'attribut postalCode de l'objet users, la valeur de $postalCode
$users->postalCode = $postalCode;
// On utilise la méthode searchTaxiByPostalCodeDeparture() pour récupérer les chauffeurs de taxi ayant le même code postal
$taxiBooking = $users->searchTaxiByPostalCodeDeparture();

if (isset($_POST['viewProfile'])) {
    $_SESSION['idTaxi'] = strip_tags($_POST['idTaxi']);
    header('location: taxiProfile.php');
    exit;
}