<?php
$users = new users();
$users->id = intval(strip_tags($_POST['idTaxi']));
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();