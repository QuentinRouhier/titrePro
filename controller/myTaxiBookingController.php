<?php
//instanciation de la class users()
$users = new users();
//recupere la valeur de l'input de type hidden pour connaitre l'id tu taxi 
//et le donne à l'attribut id de l'objet users
$users->id = intval($_SESSION['idTaxi']);
//Affiche les information dans du taxi selectionner dans la varraible $getCityPostalCodeAndTaxiById
$getCityPostalCodeAndTaxiById = $users->getCityPostalCodeAndTaxiById();
//instanciation de la class comments
$comments = new comments();
// Quand le boutton deleteComment est isset
if (isset($_POST['deleteComment'])) {
    //Puis on donne à l'attribut id de l'objet comments, la valeur de l'id du commentaire
    $comments->id = strip_tags($_POST['idComment']);
    // Puis tu supprime le commentaire selectionner
    $comments->deleteComment();
}

$regexMax150Characters = '/^(.){2,150}$/i';
// quand on clic sur le boutton postComment
if (isset($_POST['postComment'])) {
    //Puis on donne à l'attribut id_taxi de l'objet comments, la valeur de la varriable de session idTaxi
    $comments->id_taxi = intval($_SESSION['idTaxi']);
    //Puis on donne à l'attribut id_taxi_users de l'objet comments, la valeur de la varriable de session id
    $comments->id_taxi_users = intval($_SESSION['id']);
    // Si l'input n'est pas vide 
    if (!empty($_POST['comment'])) {
        // Tu passe en POST la value qui es de dans puis tu le mets dans la varriable $sendComment
        $sendComment = strip_tags($_POST['comment']);
        //Si la regex ne match pas
        if (!preg_match($regexMax150Characters, $sendComment)) {
            //tu mets une erreur
            $error = REGEX_150_WORDS;
            //sinon
        } else {
            // Tu donne à l'attribut content de l'objet comments la variable contenant le message
            $comments->content = $sendComment;
            // puis tu appel la methode pour ajouter un commentaire
            $comments->addComment();
        }
        //Sinon tu mets une erreur
    } else {
        $error = REGISTER_EMPTY_VALUE;
    }
}

//Puis on donne à l'attribut id de l'objet comments, la valeur de l'input de type hidden
//pour que les commentaire du taxi s'affiche
$comments->id = intval($_SESSION['idTaxi']);
// on mets la methode getComment dans la varriable $getComment afin de faire un foreach
// et d'afficher toute les commentaires.
$getComment = $comments->getComment();