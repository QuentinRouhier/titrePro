<?php
// Instanciation de la classe comments
$comments = new comments();
// On donne à l'attribut id de l'objet comments, la valeur de la varriable de session id
$comments->id = intval($_SESSION['id']);
// Puis on le stock dans une variable $getComment pour faire un foreach afin d'afficher tous
//les commentaires que le taxi a eu.
$getComment = $comments->getComment();
