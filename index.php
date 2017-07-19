<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/booking.php';
include_once 'controller/indexController.php';
?>
<!doctype html>
<html>
    <head>
        <title>taxi</title>
        <meta charset="UTF-8"/>
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
        <?= var_dump($_SESSION) ?>
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="#">
                            <img src="assets/images/logoTaxi.jpg" alt=""/>
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
                        <?php if (!empty($_SESSION)) { ?> 
                            <form method="POST" action="index.php">
                                <?php if (!empty($_SESSION['id_taxi_group'] == 1)) { ?> 
                                    <a href="myBookin.php" class="btn btn-primary navbar-btn"><?= MY_BOOKING ?></a>
                                <?php } ?>
                                <a href="/modification" class="btn btn-success navbar-btn"><?= EDIT ?></a>
                                <button name="logOut" type="submit" class="btn btn-warning navbar-btn" ><?= LOG_OUT ?></button>
                            </form>
                            <?php
                        } else {
                            ?>
                            <a href="/register.php" class="btn btn-success navbar-btn"><?= SIGN_UP ?></a>
                            <button data-toggle="modal" data-target="#ModalConnexion" class="btn btn-primary navbar-btn"><?= SIGN_IN ?></button>
                        <?php }
                        ?>
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
                    <form action="index.php" method="POST">
                        <div class="modal-body">
                            <span id="errorLogin"><?= LOGINE ?></span>
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
                    <h2><?= USER_CONNECT ?></h2>
                    <form action="index.php" method="POST" class="form-vertical">
                        <div class="row form-group <?= isset($errorList['placeOfDeparture']) ? 'has-error' : '' ?>">
                            <label class="control-label col-sm-2" for="placeOfDeparture"><?= DEPARTURE ?></label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control controls" name="placeOfDeparture" id="placeOfDeparture" value="<?= $booking->placeOfDeparture ?>" placeholder="60400, Noyon, rue de paris" required>
                                <p class="help-block"><?= isset($errorList['placeOfDeparture']) ? $errorList['placeOfDeparture'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group <?= isset($errorList['arrivalPoint']) ? 'has-error' : '' ?>">
                            <label class="control-label col-sm-2" for="arrivalPoint"><?= ARRIVAL ?></label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" name="arrivalPoint" id="arrivalPoint" value="<?= $booking->arrivalPoint ?>" required>
                                <p class="help-block"><?= isset($errorList['arrivalPoint']) ? $errorList['arrivalPoint'] : '' ?></p>
                            </div>
                        </div>
                        <div class="row form-group">
                            <div clas="<?= isset($errorList['timeOfArrival']) ? 'has-error' : '' ?>">
                                <label class="control-label col-sm-2" for="timeOfArrival"><?= TIME_ARRIVAL ?></label>
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
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <!-- JS fenetre modal -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!-- JS du mask -->
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <!-- JS du login -->
        <script src="assets/js/login.js" type="text/javascript"></script>
        <!--Js du date picker et la locale pour le français -->
        <script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/locales/bootstrap-datepicker.fr.min.js" type="text/javascript"></script>
        <script src="assets/js/datePicker.js" type="text/javascript"></script>
        <!--Js du timePicker -->
        <script src="assets/js/timepicker.js" type="text/javascript"></script>
        <script>$('#timeOfArrival').timepicker();</script>
        <script src="assets/js/googleApi.js" type="text/javascript"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCRpy8qNcQ9TFoCaQCRf_0Y9zU33md5BcA&libraries=places&callback=initAutocomplete" async defer></script>  
    </body>
</html>