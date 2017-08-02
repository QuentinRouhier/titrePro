<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'controller/deleteController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Suppression de votre compte</title>
        <meta charset="UTF-8">
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
                        <li><a href="/accueil" >Accueil</a></li>
                        <?php
                        if (!empty($_SESSION)) {
                            ?>
                            <li><a href="/modification" ><?= EDIT ?></a></li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </nav>
        <div class="container-fluid">
            <h1 class="text-center"> Suppression de ton compte </h1>
            <form action="delete.php" method="POST">
                <div class="row form-group <?= (!empty($error)) ? 'has-error' : '' ?>">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="password">tapez votre mot de passe :*</label>
                    <div class="col-sm-4 ">
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="row form-group col-md-offset-5">
                        </div>
                        <p class="help-block"><?= (!empty($error)) ? $error : '' ?></p>
                    </div>
                </div>
                <button type="submit" name="delete" class="btn btn-danger btn-lg center-block">supprimer</button>
            </form>
        </div>
        <?php include_once 'footer.php' ?>
        <!-- Pour fair fonctionner la navbar en responsive -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>