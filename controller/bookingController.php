<?php

// Instanciation de la classe users
$users = new users();
// On récupère le valeur de par la session $_SESSION['placeOfDeparture']
$placeOfDeparture = $_SESSION['placeOfDeparture'];
// On stock ce qui a avant et apres le '->' ceci fait un tableau, on la stock dans $postalCode
$placeOfDepartureArray = explode(' -> ', $placeOfDeparture);
//On recupere la partit qui nous interesse donc le code postal
$postalCode = $placeOfDepartureArray[1];
// On donne à l'attribut postalCode de l'objet users, la valeur de $postalCode
$users->postalCode = intval($postalCode);
// On utilise la méthode searchTaxiByPostalCodeDeparture() pour récupérer 
// les chauffeurs de taxi ayant le code postal qui commence pa les deux meme chiffres.
$taxiBooking = $users->searchTaxiByPostalCodeDeparture();
//si viewProfile est isset on le passe en post
if (isset($_POST['viewProfile'])) {
    // On stock dans une variable de session la valeur de l'input hidden
    $_SESSION['idTaxi'] = strip_tags($_POST['idTaxi']);
    // Puis on redirige vers la page ou l'on affiche plus d'information sur le taxi selectionner
    header('location: /profil_taxi');
    //On s'assure que la suite du code ne soit pas exécutée une fois la redirection effectuée.
    exit;
}