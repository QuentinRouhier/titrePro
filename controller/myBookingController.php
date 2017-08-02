<?php

// Instanciation de la classe users
$users = new users();
//Puis on donne à l'attribut id de l'objet users, la valeur de la varriable de session id
$users->id = intval($_SESSION['id']);
// on mets la methode getBookingById dans la varriable $getBookingById afin de faire un foreach
// et d'afficher toute les reservation passer.
$getBookingById = $users->getBookingById();
//si viewProfile est isset 
if (isset($_POST['viewProfile'])) {
    // on mets l'input idTaxi qui est hidden dans une variable de session idTaxi
    $_SESSION['idTaxi'] = strip_tags($_POST['idTaxi']);
    header('location: myTaxiBooking.php');
    exit;
}
