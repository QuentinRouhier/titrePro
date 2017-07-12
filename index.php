<?php
session_start();
//On inclut tous les fichiers nécessaires et dans le bon ordre.
include_once 'configuration.php';
include_once 'class/database.php';
include_once 'lang/FR_FR.php';
include_once 'model/users.php';
include_once 'controller/indexController.php';
?>
<!doctype html>
<html>
    <head>
        <title>taxi</title>
        <meta charset="UTF-8"/>
        <link href="assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <script src="assets/js/bootstrap.js" type="text/javascript"></script>
        <script src="https://code.jquery.com/jquery-3.2.1.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css"/>
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
                        <?php if (!empty($_SESSION)) {
                            ?> 
                            <form method="POST" action="index.php">
                                <a href="register.php" class="btn btn-success navbar-btn"><?= EDIT ?></a>
                                <button name="logOut" type="submit" class="btn btn-warning navbar-btn" ><?= LOG_OUT ?></button>
                            </form>
                            <?php
                        } else {
                            ?>
                            <a href="register.php" class="btn btn-success navbar-btn"><?= SIGN_UP ?></a>
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
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name="longIn" class="btn btn-primary"><?= SIGN_IN ?></button>
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
                        <h1><?= USER_DISCONNECT ?></h1>
                        <a href="register.php" class="btn btn-success btn-lg"><?= SIGN_UP ?></a>
                        <button data-toggle="modal" data-target="#ModalConnexion" class="btn btn-primary btn-lg"><?= SIGN_IN ?></button>    
                    </div>
                    <?php
                } else {
                    ?>
                    <h2><?= USER_CONNECT ?></h2>
                    <form action="index.php" method="POST" class="form-vertical">
                        <div class="row form-group" id="divSociety">
                            <label class="control-label col-sm-2" for="departure"><?= DEPARTURE ?></label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" name="departure" id="departure" value="">
                            </div>
                        </div>
                        <div class="row form-group" id="divSociety">
                            <label class="control-label col-sm-2" for="arrival"><?= ARRIVAL ?></label>
                            <div class="col-sm-9 ">
                                <input type="text" class="form-control" name="arrival" id="arrival" value="">
                            </div>
                        </div>
                        <div class="col-sm-offset-5 col-sm-2">
                        <input type="submit" name="delete" id="booking" value="<?= BOOKING ?>" class="form-control"/>
                        </div>
                    </form>
                <?php } ?>
            </div>
        </div>
    </body>
</html>