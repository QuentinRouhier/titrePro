<?php

//instanciation de la class users()
$users = new users();
//recupere la valeur de l'input de type hidden pour connaitre l'id tu taxi
$users->id = intval($_SESSION['idTaxi']);
//Affiche les information dans une variable
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();
$comments = new comments();

if (isset($_POST['deleteComment'])) {
    $comments->id = strip_tags($_POST['idComment']);
    $comments->deleteComment();
}

$regexMax150Characters = '/^(.){2,150}$/i';
if (isset($_POST['postComment'])) {
    $comments->id_taxi = intval($_SESSION['idTaxi']);
    $comments->id_taxi_users = intval($_SESSION['id']);
    if (!empty($_POST['comment'])) {
        // Tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
        $sendComment = strip_tags($_POST['comment']);
        //Si la regex ne match pas
        if (!preg_match($regexMax150Characters, $sendComment)) {
            //tu mets une erreur
            $error = REGEX_150_WORDS;
        } else {
            $comments->content = $sendComment;
            $comments->addComment();
        }
        //Sinon tu mets une erreur
    } else {
        $error = REGISTER_EMPTY_VALUE;
    }
}
$comments->id = intval($_SESSION['idTaxi']);
$getComment = $comments->getComment();

