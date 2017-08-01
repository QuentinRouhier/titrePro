<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/booking.php';
include_once 'controller/organizerController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mon agenda</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="/accueil">
                            <img src="assets/images/logoTaxi.jpg" alt="logoTaxi" title="logoTaxi"/>
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
                        <a href="/accueil" class="btn btn-success navbar-btn" >Accueil</a>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php
                foreach ($getOrganizerById as $organizer) {
                    ?>
                    <div class="row">
                        <p class="control-label col-sm-2"><?= LAST_NAME ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->lastName ?></p>
                        </div>
                        <p class="control-label col-sm-2"><?= FIRST_NAME ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->firstName ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="control-label col-sm-2"><?= DEPARTURE_POSTAl_CODE ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->postalCodeDeparture ?> <?= $organizer->placeOfDeparture ?></p>
                        </div>
                        <p class="control-label col-sm-2"><?= ADDRESS_OF_DEPARTURE ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->addressPlaceOfDeparture ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="control-label col-sm-2"><?= ARRIVAL_POSTAl_CODE ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->postalCodeArrivalPoint ?> <?= $organizer->arrivalPoint ?></p>
                        </div>
                        <p class="control-label col-sm-2"><?= ADDRESS_OF_ARRIVAL ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->addressArrivalPoint ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="control-label col-sm-2"><?= TIME_OF_ARRIVAL ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->timeOfArrival ?></p>
                        </div>
                        <p class="control-label col-sm-2"><?= DATE_OF_ARRIVAL ?></p>
                        <div class="col-sm-4">
                            <p><?= date_format(date_create($organizer->dateOfDepartur), 'd/m/Y') ?></p>
                        </div>
                    </div>
                    <div class="row">
                        <p class="control-label col-sm-2"><?= PHONE_CLIENT ?></p>
                        <div class="col-sm-4">
                            <p><?= $organizer->firstPhoneNumber ?></p>
                        </div>
                        <?php
                        if (!empty($organizer->secondPhoneNumber)) {
                            ?>
                            <p class="control-label col-sm-2"><?= PHONE_CLIENT_2 ?></p>
                            <div class="col-sm-4">
                                <p><?= $organizer->secondPhoneNumber ?></p>
                            </div>
                        <?php } ?>
                    </div>
                    <hr>
                    <?php
                }
                ?>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
    </body>
</html>
