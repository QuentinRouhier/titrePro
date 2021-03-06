<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/group.php';
include_once 'model/users.php';
include_once 'model/location.php';
include_once 'controller/registerController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title><?= !empty($_SESSION) ? 'Profil' : 'Inscription' ?></title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width">
        <link rel="icon" href="assets/images/favicon.ico">
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <!--Css du datepicker-->
        <link href="assets/css/bootstrap-datepicker3.css" rel="stylesheet" type="text/css"/>
        <link href="assets/css/bootstrap-datepicker3.standalone.css" rel="stylesheet" type="text/css"/>
        <!-- mask pour le téléphone-->
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/css/jasny-bootstrap.min.css">
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
                <?php var_dump($_SESSION) ?>
                <div class="collapse navbar-collapse" id="navbar-burger">
                    <ul class="nav navbar-nav navbar-right">
                        <li><a href="/accueil">Accueil</a></li>
                        <?php
                        // si la session n'est pas vide tu affiche "supprimer votre comptre"
                        if (!empty($_SESSION)) {
                            ?>
                            <li><a href="/suppression">Supprimer votre compte  </a></li>
                            <?php
                            // si id taxi group = 1 donc qu'il est taxi tu affiche "voir les commentaire"
                            if ($_SESSION['id_taxi_group'] == 1) {
                                ?>
                                <li><a href="/mes_commentaires">Voir mes commentaires  </a></li>
                                <?php
                            }
                        }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <h1 class="text-center"><?= !empty($_SESSION) ? UPDATE_USER : REGISTER_TITLE ?></h1>
            <h2 class="text-center"><?= $message ?></h2>
            <form action="register.php" method="POST" class="form-vertical">
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3 col-sm-2" for="group"><?= REGISTER_GROUP ?></label>
                    <div class="col-sm-4">
                        <select name="group"  id="group" class="form-control">
                            <?php
                            foreach ($groupList as $groups) {
                                ?>     
                                <option value="<?= $groups->id ?>" <?= !empty($_SESSION) ? ($groups->id == $_SESSION['id_taxi_group'] ? 'selected' : '' ) : ($groups->id == $users->id_taxi_group ? 'selected' : ''); ?>><?= $groups->name ?></option>
                                <?php
                            }
                            ?>
                        </select>
                    </div>
                </div>
                <div class="row form-group <?= isset($errorList['society']) ? 'has-error' : '' ?>" id="divSociety">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="society"><?= REGISTER_SOCIETY ?></label>
                    <div class="col-sm-4 ">
                        <input type="text" class="form-control" name="society" id="society" value="<?= !empty($_SESSION) ? $_SESSION['society'] : $users->society ?>" maxlength="100" minlength="3" <?= isset($errorList['group']) == 1 ? 'required' : '' ?>>
                        <p class="help-block"><?= isset($errorList['society']) ? $errorList['society'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group <?= isset($errorList['describeSociety']) ? 'has-error' : '' ?>" id="divDescribeSociety">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="describeSociety"><?= REGISTER_DESCRIBE_SOCIETY ?></label>
                    <div class="col-sm-4 ">
                        <textarea class="form-control" rows="5" name="describeSociety" id="describeSociety"  maxlength="500" minlength="3" <?= isset($errorList['group']) == 1 ? 'required' : '' ?>><?= !empty($_SESSION) ? $_SESSION['describeSociety'] : $users->describeSociety ?></textarea>
                        <p class="help-block"><?= isset($errorList['describeSociety']) ? $errorList['describeSociety'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="lastName"><?= REGISTER_LASTNAME ?></label>
                    <div class="col-sm-4 <?= isset($errorList['lastName']) ? 'has-error' : '' ?>">
                        <input type="text" class="form-control" name="lastName" id="lastName" value="<?= !empty($_SESSION) ? $_SESSION['lastName'] : $users->lastName ?>" required>         
                        <p class="help-block"><?= isset($errorList['lastName']) ? $errorList['lastName'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="firstName"><?= REGISTER_FIRSTNAME ?></label>
                    <div class="col-sm-4 <?= isset($errorList['firstName']) ? 'has-error' : '' ?>">
                        <input type="text" class="form-control" name="firstName" id="firstName" value="<?= !empty($_SESSION) ? $_SESSION['firstName'] : $users->firstName ?>" required>         
                        <p class="help-block"><?= isset($errorList['firstName']) ? $errorList['firstName'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="firstPhoneNumber"><?= REGISTER_FIRSTPHONENUMBER ?></label>
                    <div class="col-sm-4 <?= isset($errorList['firstPhoneNumber']) ? 'has-error' : '' ?>">
                        <input type="text" class="form-control" name="firstPhoneNumber" id="firstPhoneNumber" value="<?= !empty($_SESSION) ? wordwrap($_SESSION['firstPhoneNumber'], 2, '.', 1) : $users->firstPhoneNumber ?>" required data-mask="09.99.99.99.99">
                        <p class="help-block"><?= isset($errorList['firstPhoneNumber']) ? $errorList['firstPhoneNumber'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="secondPhoneNumber"><?= REGISTER_SECONDPHONENUMBER ?></label>
                    <div class="col-sm-4 <?= isset($errorList['secondPhoneNumber']) ? 'has-error' : '' ?>">
                        <input type="text" class="form-control" name="secondPhoneNumber" id="secondPhoneNumber" value="<?= !empty($_SESSION) ? wordwrap($_SESSION['secondPhoneNumber'], 2, '.', 1) : $users->secondPhoneNumber ?>" data-mask="09.99.99.99.99">
                        <p class="help-block"><?= isset($errorList['secondPhoneNumber']) ? $errorList['secondPhoneNumber'] : '' ?></p>

                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="postalCode"><?= REGISTER_POSTALCODE ?></label>
                    <div class="col-sm-4 <?= isset($errorList['postalCode']) ? 'has-error' : '' ?>">
                        <input autocomplete="off" list="postal_code" type="text" class="form-control" name="postalCode" id="postalCode" value="<?= !empty($_SESSION) ? $locationsListt[0]->postalCode : $users->postalCode ?>" minlength="5" maxlength="5" required>
                        <p class="help-block"><?= isset($errorList['postalCode']) ? $errorList['postalCode'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="city"><?= REGISTER_CITY ?></label>
                    <div class="col-sm-4 <?= isset($errorList['city']) ? 'has-error' : '' ?>">
                        <select type="text" class="form-control" name="city" id="city" >
                            <?php
                            if (isset($_SESSION['id'])) {
                                foreach ($locationsListt as $locationsDetails) {
                                    ?>
                            <option value="<?= $locationsDetails->id ?>" <?= $_SESSION && $locationsDetails->city == $location->city ? 'selected' : '' ?>><?= $locationsDetails->city ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                        <p class="help-block"><?= isset($errorList['city']) ? $errorList['city'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="address"><?= REGISTER_ADDRESS ?></label>
                    <div class="col-sm-4 <?= isset($errorList['address']) ? 'has-error' : '' ?>">
                        <input type="text" class="form-control" name="address" id="address" value="<?= !empty($_SESSION) ? $_SESSION['address'] : $users->address ?>" required>
                        <p class="help-block"><?= isset($errorList['address']) ? $errorList['address'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="birthDate"><?= REGISTER_BIRTHDATE ?></label>
                    <div class="col-sm-4 <?= isset($errorList['birthDate']) ? 'has-error' : '' ?>">
                        <input type="text" data-provide="datepicker" class="form-control datepicker" name="birthDate" id="birthDate" value="<?= !empty($_SESSION) ? date_format(date_create($_SESSION['birthDate']), 'd/m/Y') : $users->birthDate ?>" required data-mask="99/99/9999">
                        <p class="help-block"><?= isset($errorList['birthDate']) ? $errorList['birthDate'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="email"><?= REGISTER_EMAIL ?></label>
                    <div class="col-sm-4 <?= isset($errorList['email']) ? 'has-error' : '' ?>">
                        <input type="email" class="form-control" name="email" id="email" value="<?= !empty($_SESSION) ? $_SESSION['email'] : $users->email ?>" required>
                        <p class="help-block"><?= isset($errorList['email']) ? $errorList['email'] : '' ?></p>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="password"><?= REGISTER_PASSWORD ?></label>
                    <div class="col-sm-4 <?= isset($errorList['confirmPassword']) ? 'has-error' : '' ?>">
                        <input type="password" class="form-control" name="password" id="password" required>
                    </div>
                </div>
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="confirmPassword"><?= REGISTER_CONFIRMPASSWORD ?></label>
                    <div class="col-sm-4 <?= isset($errorList['confirmPassword']) ? 'has-error' : '' ?>">
                        <input type="password" class="form-control" name="confirmPassword" id="confirmPassword" required>
                        <p class="help-block"><?= isset($errorList['confirmPassword']) ? $errorList['confirmPassword'] : '' ?></p>
                    </div>
                </div>
                <button type="submit" name="register" class="btn btn-primary btn-lg center-block"><?= !empty($_SESSION) ? UPDATE : REGISTER_REGISTER ?></button>
            </form>
        </div>
        <?php include_once 'footer.php' ?>
        <!-- pour le mask du telephone -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="//cdnjs.cloudflare.com/ajax/libs/jasny-bootstrap/3.1.3/js/jasny-bootstrap.min.js"></script>
        <!-- Pour fair fonctionner la navbar en responsive -->
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <!--Js du date picker et la locale pour le français -->
        <script src="assets/js/bootstrap-datepicker.min.js" type="text/javascript"></script>
        <script src="assets/js/bootstrap-datepicker.fr.min.js" type="text/javascript"></script>
        <script src="assets/js/datePicker.js" type="text/javascript"></script>
        <!-- ajax -->
        <script src="assets/js/postalCodeList.js" type="text/javascript"></script>
        <script src="assets/js/groupClients.js" type="text/javascript"></script>
    </body>
</html>
