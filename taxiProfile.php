<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/location.php';
include_once 'model/booking.php';
include_once 'controller/taxiProfileController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Profile du taxi demandé</title>
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
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= LAST_NAME ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->lastName ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= FIRST_NAME ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->firstName ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= SOCIETY ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->society ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= DESCRIBE_SOCIETY ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->describeSociety ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= POSTAL_CODE ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->postalCode ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= CITY ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->city ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= FIRST_PHONE_NUMBER ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->firstPhoneNumber ?></p>
                        </div>
                    </div>
                    <?php
                    if (!empty($viewTaxi->secondPhoneNumber)) {
                        ?>
                        <div class="row form-group">
                            <p class="control-label col-sm-3"><?= SECOND_PHONE_NUMBER ?></p>
                            <div class="col-sm-9">
                                <p><?= $viewTaxi->secondPhoneNumber ?></p>
                            </div>
                        </div>
                    <?php } ?>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= ADDRESS ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->address ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <p class="control-label col-sm-3"><?= EMAIL ?></p>
                        <div class="col-sm-9">
                            <p><?= $viewTaxi->email ?></p>
                        </div>
                    </div>
                    <div class="row form-group">
                        <div class="col-sm-offset-5 col-sm-2">
                            <input type="submit" name="viewProfile" id="viewProfile" value="<?= VIEW_PROFILE ?>" class="form-control"/>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </body>
</html>