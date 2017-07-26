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
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
    </head>
    <body>
        <?= var_dump($_SESSION) ?>
        <div class="container-fluid">
            <h1 class="col-sm-offset-3"> Suppression de ton compte </h1>
            <form action="delete.php" method="POST">
                <div class="row form-group">
                    <label class="control-label col-sm-offset-3  col-sm-2" for="password">suppression</label>
                    <div class="col-sm-4 ">
                        <input type="password" class="form-control" name="password" id="password" required>
                        <div class="row form-group col-md-offset-5">
                            <button type="submit" name="delete" class="btn btn-primary btn-lg">supprimer</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </body>
</html>