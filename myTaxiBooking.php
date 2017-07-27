<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/location.php';
include_once 'model/booking.php';
include_once 'controller/myTaxiBookingController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mes résérvation</title>
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
                foreach ($getCityPostalCodeAndTaxiById as $viewTaxi) {
                    ?>
                    <div class="row">
                        <p class="control-label col-sm-4"><?= LAST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->lastName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= FIRST_NAME ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->firstName ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->society ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= DESCRIBE_SOCIETY ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->describeSociety ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= POSTAL_CODE ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->postalCode ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= CITY ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->city ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= FIRST_PHONE_NUMBER ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->firstPhoneNumber ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($viewTaxi->secondPhoneNumber)) {
                        ?>
                        <div class="row ">
                            <p class="control-label col-sm-4"><?= SECOND_PHONE_NUMBER ?></p>
                            <div class="col-sm-8">
                                <p><?= $viewTaxi->secondPhoneNumber ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row">
                        <p class="control-label col-sm-4"><?= ADDRESS ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->address ?></p>
                        </div>
                    </div>
                    <div class="row ">
                        <p class="control-label col-sm-4"><?= EMAIL ?></p>
                        <div class="col-sm-8">
                            <p><?= $viewTaxi->email ?></p>
                        </div>
                    </div>
                <?php } ?>
                <hr>
                <div class="row">
                    <form action="taxiProfile.php" method="POST">
                        <label class="control-label col-sm-5" for="comment"><?= COMMENT ?></label> :
                        <textarea type="text" name="comment" id="comment" placeholder="Laissez un commentaire" maxlength="150" required></textarea>
                        <button type="submit" name="chooseTaxi" id="chooseTaxi" class="form-control"><?= CHOOSE_TAXI ?></button>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>
