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
        <nav class="navbar navbar-inverse navbar-static-top" role="navigation">
            <div class="container-fluid">
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-burger">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="navbar-burger">
                    <div class="navbar-header">
                        <a class="brand" href="#"> <img src="assets/images/logoTaxi.jpg" alt=""/></a>
                    </div>
                    <ul class="nav navbar-nav navbar-right">
                        <?php if (!empty($_SESSION)) {
                            ?> 
                            <form method="POST" action="index.php">
                                <li><button name="logOut" type="submit" class="btn btn-warning" ><span class="glyphico nglyphicon-log-out"></span>Déconnexion</button></li>
                                <li><button name="profile" type="submit" class="btn btn-success" >Profil</button></li>
                            </form>
                            <?php
                        } else {
                            ?>
                            <li><a href="#"><span class="glyphicon glyphicon-user"></span>Inscription</a></li>
                            <li><a href="#" data-toggle="modal" data-target="#exampleModalLong"><span class="glyphicon glyphicon-log-in"></span>Connexion</a></li>
                        <?php }
                        ?>
                    </ul>
                </div>
            </div>
        </nav>
        <!-- modal connexion -->
        <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        <h2 class="modal-title">Connexion</h2>
                    </div>
                    <form action="index.php" method="POST">
                        <div class="row form-group">
                            <label class="control-label col-sm-2" for="email"><?= REGISTER_EMAIL ?></label>
                            <div class="col-sm-9">
                                <input type="email" class="form-control" name="email" id="email" value="<?= $users->email ?>" required>
                            </div>
                        </div>
                        <div class="modal-body">
                            <div class="row form-group">
                                <label class="control-label col-sm-2" for="password"><?= REGISTER_PASSWORD ?></label>
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" name="password" id="password" required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Fermer</button>
                            <button type="submit" name="longIn" class="btn btn-primary">Connexion</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </body>
</html>