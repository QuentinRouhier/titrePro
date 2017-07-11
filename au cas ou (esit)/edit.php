<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/group.php';
include_once 'controller/editController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title>Modification du profil</title>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--Css du datepicker-->
        <link href="assets/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-datepicker3.standalone.css" rel="stylesheet" type="text/css"/>
        <!-- mask pour le téléphone-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
    </head>
    <body>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php 
                if ($_SESSION['id'] == 1){
                ?>
                <div class="row form-group" id="divSociety">
                    <label class="control-label col-sm-2" for="society"><?= REGISTER_SOCIETY ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control" name="society" id="society" value="<?= $_SESSION['society'] ?>" >
                    </div>
                </div>
            <?php } ?>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="lastName"><?= REGISTER_LASTNAME ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control" name="lastName" id="lastName" value="<?= $_SESSION['lastName'] ?>" required>         
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="firstName"><?= REGISTER_FIRSTNAME ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control" name="firstName" id="firstName" value="<?= $_SESSION['firstName'] ?>" required>         
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="firstPhoneNumber"><?= REGISTER_FIRSTPHONENUMBER ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control" name="firstPhoneNumber" id="firstPhoneNumber" value="<?= $_SESSION['firstPhoneNumber']?>" required data-mask="09.99.99.99.99">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="secondPhoneNumber"><?= REGISTER_SECONDPHONENUMBER ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" class="form-control" name="secondPhoneNumber" id="secondPhoneNumber" value="<?= $_SESSION['secondPhoneNumber'] ?>" data-mask="09.99.99.99.99">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="postalCode"><?= REGISTER_POSTALCODE ?></label>
                    <div class="col-sm-9 ">
                        <input autocomplete="off" list="postal_code" type="text" class="form-control" name="postalCode" id="postalCode" value="<?= $_SESSION['postalCode'] ?>" minlength="5" maxlength="5" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="city"><?= REGISTER_CITY ?></label>
                    <div class="col-sm-9 ">
                        <select type="text" class="form-control" name="city" id="city" value="<?= $_SESSION['postalCode'] ?>" ></select>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="address"><?= REGISTER_ADDRESS ?></label>
                    <div class="col-sm-9">
                        <input type="text" class="form-control" name="address" id="address" value="<?=  $_SESSION['address'] ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="birthDate"><?= REGISTER_BIRTHDATE ?></label>
                    <div class="col-sm-9 ">
                        <input type="text" data-provide="datepicker" class="form-control datepicker" name="birthDate" id="birthDate" value="<?= $_SESSION['birthDate'] ?>" required data-mask="99/99/9999">
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="email"><?= REGISTER_EMAIL ?></label>
                    <div class="col-sm-9 ">
                        <input type="email" class="form-control" name="email" id="email" value="<?= $_SESSION['email'] ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="password"><?= REGISTER_PASSWORD ?></label>
                    <div class="col-sm-9 ">
                        <input type="password" class="form-control" name="password" id="password" value="<?= $_SESSION['password'] ?>" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-2" for="confirmPassword"><?= REGISTER_CONFIRMPASSWORD ?></label>
                    <div class="col-sm-9 ">
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" value="<?= $_SESSION['password'] ?>" required>
                    </div>
                </div>
                <div class="row form-group col-md-offset-4 col-md-4">
                    <input type="submit" name="register" value="<?= REGISTER_REGISTER ?>" class="form-control"/>
                </div> 
            </div>
        </div>
        <!-- pour le mask du telephone -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <!--Js du date picker et la locale pour le français -->
        <script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/locales/bootstrap-datepicker.fr.min.js" type="text/javascript"></script>
    </body>
</html>
