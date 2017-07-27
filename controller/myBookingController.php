<?php
$users = new users();
$users->id = intval($_SESSION['id']);
$getBookingById = $users->getBookingById();

if (isset($_POST['viewProfile'])) {
$users->id = intval($_SESSION['idTaxi']);
    $_SESSION['idTaxi'] = strip_tags($_POST['idTaxi']);
    header('location: myTaxiBooking.php');
    exit;
}
