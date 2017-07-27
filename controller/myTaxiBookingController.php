<?php

//instantiation de la class users()
$users = new users();
//recupere la valeur de l'input de type hidden pour connaitre l'id tu taxi
$users->id = intval($_SESSION['idTaxi']);
//Affiche les information dans un foreach
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();