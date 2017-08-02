<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/location.php';
include_once 'model/booking.php';
include_once 'controller/bookingController.php';
?>
<!doctype html>
<html>
    <head>
        <title>Réservation</title>
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
                        <a class="navbar-brand" href="/accueil">
                            <img src="assets/images/logoTaxi.jpg" alt="logoTaxi" title="logoTaxi"/>
                        </a>
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-burger">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-burger">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/accueil" >Accueil</a></li>
                    </ul>
                </div>
            </div>
        </nav>
        <h1 class="text-center"><?= TAXI ?></h1>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php
                foreach ($taxiBooking as $taxiList) {
                    ?>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= LAST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $taxiList->lastName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= FIRST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $taxiList->firstName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= POSTAL_CODE ?></p>
                        <div class="col-sm-8">
                            <p><?= $taxiList->postalCode ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $taxiList->society ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= DESCRIBE_SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $taxiList->describeSociety ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <div class="col-sm-offset-5 col-sm-2">
                            <form action="booking.php" method="POST">
                                <input type="hidden" name="idTaxi" id="idTaxi" value="<?= $taxiList->id ?>"/>
                                <button type="submit" name="viewProfile" class="btn btn-success"><?= VIEW_PROFILE ?></button>
                            </form>
                        </div>
                    </div>
                    <hr>
                <?php } ?>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <!-- Pour fair fonctionner la navbar en responsive -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
