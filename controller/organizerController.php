<?php
//instanciation de la class booking().
$booking = new booking();
//Puis on donne à l'attribut id de l'objet booking, la valeur de la varriable de session id.
$booking->id = $_SESSION['id'];
//Afin de pouvoir afficher toutes les reservations dans un foreach.
$getOrganizerById = $booking->getOrganizerById();