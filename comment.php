<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'model/comments.php';
include_once 'controller/commentController.php';
?>
<!DOCTYPE html>
<html>
    <head>
        <title>Mes commentaires</title>
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
        <h1 class="text-center"><?= MY_COMMENT ?></h1>
        <div class="container-fluid">
            <div class="row col-lg-offset-2 col-sm-8 ">
                <?php
                if (empty($viewComment->content)) {
                    ?>
                    <div class="row">
                        <p class="text-center"> <?= THE_COMMENT ?> </p>
                        <?php
                        foreach ($getComment as $viewComment) {
                            ?>
                            <div class="comment">
                                <p class="col-sm-10"><?= $viewComment->firstName ?> <?= $viewComment->lastName ?> :</p>
                                <p> <?= PUBLISH_DATE, date_format(date_create($viewComment->publishDate), 'd/m/Y') ?> </p>
                                <div class="borderComment">
                                    <p> <?= $viewComment->content ?></p>
                                </div>
                            </div>
                            <?php
                        }
                    } else {
                        ?>
                        <p class="col-sm-10"><?= NO_COMMENTS ?></p> 
                    </div>
                <?php } ?>
            </div>
        </div>
        <?php include_once 'footer.php' ?>
        <!-- Pour fair fonctionner la navbar en responsive -->
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
    </body>
</html>
