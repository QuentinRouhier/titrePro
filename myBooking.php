<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/booking.php';
include_once 'controller/myBookingController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mes réservation</title>
        <meta charset="UTF-8"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#"><span class="signelogo">
                                <img src="assets/images/logoTaxi.jpg" alt=""/>
                            </span>
                        </a>
                    </div>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-burger">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-burger">
                    <ul class="nav navbar-nav navbar-right">
                        <a href="index.php" class="btn btn-success navbar-btn" >Accueil</a>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php
                foreach ($getBookingById as $getBooking) {
                    ?>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= LAST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $getBooking->lastName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= FIRST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $getBooking->firstName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $getBooking->society ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= DESCRIBE_SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $getBooking->describeSociety ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= DATE_OF_DEPARTURE ?></p>
                        <div class="col-sm-8">
                            <p><?= date_format(date_create($getBooking->dateOfDepartur), 'd/m/Y') ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= TIME_OF_ARRIVAL ?></p>
                        <div class="col-sm-8">
                            <p><?= $getBooking->timeOfArrival ?></p>
                        </div>
                    </div>
                    <form action="myBooking.php" method="POST">
                        <input type="hidden" name="idTaxi" id="idTaxi" value="<?= $getBooking->id ?>"/>
                        <button type="submit" name="viewProfile" class="btn btn-success"><?= VIEW_PROFILE ?></button>
                    </form>
                    <hr>
                <?php } ?>
            </div>
        </div>
    </body>
</html>