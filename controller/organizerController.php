<?php
$booking = new booking();
$booking->id = $_SESSION['id'];
$getOrganizerById = $booking->getOrganizerById();