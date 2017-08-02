<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/booking.php';
include_once 'model/location.php';
include_once 'controller/indexController.php';
?>
<!doctype html>
<html>
    <head>
        <title>taxi</title>
        <meta charset="UTF-8"/>
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
        <!--Css du timepicker-->
        <link href="assets/css/timepicker.css" rel="stylesheet" type="text/css"/>
        <!--Css du datepicker-->
        <link href="assets/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-datepicker3.standalone.css" rel="stylesheet" type="text/css"/>
        <!-- mask -->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
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
                        <?php if (!empty($_SESSION)) { ?> 
                            <?php if (!empty($_SESSION['id_taxi_group'] == 1)) { ?> 
                                <li><a href="/agenda" ><?= ORGANIZER ?></a></li>
                            <?php } ?>
                            <li><a href="/mes_reservation" title="Réservation" ><?= MY_BOOKING ?></a></li>
                            <li><a href="/modification" ><?= EDIT ?></a></li>
                            <li><a href="index.php?logOut" title="Se déconnecter" ><?= LOG_OUT ?></a></li>
                            <?php
                        } else {
                            ?>
                            <li><a href="/register.php" ><?= SIGN_UP ?></a></li>
                            <li><a href="#" data-toggle="modal" data-target="#ModalConnexion" ><?= SIGN_IN ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- modal connexion -->
        <div class="modal fade" id="ModalConnexion" tabindex="-1" role="dialog" aria-labelledby="ModalConnexion" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title"><?= SIGN_IN ?></h2>
                    </div>
                    <form action="/accueil" method="POST">
                        <div class="modal-body">
                            <div id="errorLogin"><?= LOGINE ?></div>
                            <div class="row form-group">
                                <label class="control-label col-sm-2" for="email"><?= REGISTER_EMAIL ?></label>
                                <div class="col-sm-9">
                                    <input type="email" class="form-control" name="email" id="email" value="<?= $users->email ?>" required>
                                </div>
                            </div>
                            <div class="row form-group">
                                <label class="control-label col-sm-2" for="password"><?= REGISTER_PASSWORD ?></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal"><?= CLOSE ?></button>
                            <button type="button" id="buttonLogIn" name="longIn" class="btn btn-primary"><?= SIGN_IN ?></button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php if (empty($_SESSION)) {
                    ?> 
                    <div id="home" >
                        <p><?= $message ?> </p>
                        <h1><?= USER_DISCONNECT ?></h1>
                        <a href="/inscription" class="btn btn-success btn-lg"><?= SIGN_UP ?></a>
                        <button data-toggle="modal" data-target="#ModalConnexion" class="btn btn-primary btn-lg"><?= SIGN_IN ?></button>    
                    </div>
                    <?php
                } else {
                    ?>
                    <p><?= $message ?> </p>
                    <h2 class="text-center"><?= USER_CONNECT ?></h2>
                    <form action="/accueil" method="POST" class="form-vertical">
                        <div class="row form-group <?= isset($errorList['placeOfDeparture']) ? 'has-error' : '' ?>">
                            <label class="control-label col-sm-3" for="placeOfDeparture"><?= DEPARTURE ?></label>
                            <div class="col-sm-9 ">
                                <input list="placeDeparture" type="text" class="form-control" name="placeOfDeparture" id="placeOfDeparture" value="<?= $booking->placeOfDeparture ?>" autocomplete="off" required>
                                <datalist id="placeDeparture"> </datalist>
                                <p class = "help-block"><?= isset($errorList['placeOfDeparture']) ? $errorList['placeOfDeparture'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="control-label col-sm-3" for="addressPlaceOfDeparture"><?= ADDRESS_DEPARTURE ?></label>
                            <div class="col-sm-9 <?= isset($errorList['addressPlaceOfDeparture']) ? 'has-error' : '' ?>">
                                <input type="text" class="form-control" name="addressPlaceOfDeparture" id="address" value="<?= $booking->addressPlaceOfDeparture ?>" required>
                                <p class="help-block"><?= isset($errorList['addressPlaceOfDeparture']) ? $errorList['addressPlaceOfDeparture'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group <?= isset($errorList['arrivalPoint']) ? 'has-error' : '' ?>">
                            <label class="control-label col-sm-3" for="arrivalPoint"><?= ARRIVAL ?></label>
                            <div class="col-sm-9 ">
                                <input list="destination" type="text" class="form-control" name="arrivalPoint" id="arrivalPoint" value="<?= $booking->arrivalPoint ?>" autocomplete="off" required>
                                <datalist id="destination"> </datalist>
                                <p class="help-block"><?= isset($errorList['arrivalPoint']) ? $errorList['arrivalPoint'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <label class="control-label col-sm-3" for="addressArrivalPoint"><?= ADDRESS_ARRIVAL ?></label>
                            <div class="col-sm-9 <?= isset($errorList['addressArrivalPoint']) ? 'has-error' : '' ?>">
                                <input type="text" class="form-control" name="addressArrivalPoint" id="address" value="<?= $booking->addressArrivalPoint ?>" required>
                                <p class="help-block"><?= isset($errorList['addressArrivalPoint']) ? $errorList['addressArrivalPoint'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div clas="<?= isset($errorList['timeOfArrival']) ? 'has-error' : '' ?>">
                                <label class="control-label col-sm-3" for="timeOfArrival"><?= TIME_ARRIVAL ?></label>
                                <div class="col-sm-4 ">
                                    <input type="text" class="form-control" name="timeOfArrival" id="timeOfArrival" value="<?= $booking->timeOfArrival ?>" required>
                                    <p class="help-block"><?= isset($errorList['timeOfArrival']) ? $errorList['timeOfArrival'] : '' ?></p>
                                </div>
                            </div>
                            <div clas="<?= isset($errorList['dateOfDepartur']) ? 'has-error' : '' ?>">
                                <label class="control-label col-sm-1" for="dateOfDepartur"><?= DATE_DEPARTURE ?></label>
                                <div class="col-sm-4 ">
                                    <input type="text" class="form-control" name="dateOfDepartur" id="dateOfDepartur" value="<?= $booking->dateOfDepartur ?>" data-mask="99/99/9999" required>
                                    <p class="help-block"><?= isset($errorList['dateOfDepartur']) ? $errorList['dateOfDepartur'] : '' ?></p>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-offset-5 col-sm-2">
                            <input type="submit" name="booking" id="booking" value="<?= BOOKING ?>" class="form-control"/>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- JS fenetre modal -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- JS du mask -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <!-- JS du login -->
        <script src="assets/js/login.js" type="text/javascript"></script>
        <!--Js du date picker et la locale pour le français -->
        <script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap-datepicker.fr.min.js" type="text/javascript"></script>
        <script src="assets/js/datePicker.js" type="text/javascript"></script>
        <!--Js du timePicker -->
        <script src="assets/js/timepicker.js" type="text/javascript"></script>
        <script>$('#timeOfArrival').timepicker();</script>

        <script src="assets/js/bookingLocation.js" type="text/javascript"></script>
    </body>
</html>