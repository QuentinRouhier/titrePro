<?php

// Si verifEmail et verifPassword sont isset 
if (isset($_POST['verifEmail']) && isset($_POST['verifPassword'])) {
    // Tu demare la session
    session_start();
    //Tu inclu les bon fichier dans le bon ordre
    include_once '../configuration.php';
    include_once '../lang/FR_FR.php';
    include_once '../class/database.php';
    include_once '../model/users.php';
    //Instanciation de la classe users
    $users = new users();
    // Si la variable $error est false Est qu'il n'y a pas d'erreur
    $error = false;
    // On recupere l'email et le mot de passe envoyer 
    $users->email = strip_tags($_POST['verifEmail']);
    $password = strip_tags($_POST['verifPassword']);
    // Avec la methode getHashByUser on regarde si le mots de passe correspond a celui de l'email
    $users->getHashByUser();
    //password_verify Vérifie qu'un mot de passe correspond à un hachage .
    $isOk = password_verify($password, $users->password);
    // si la mot de passe est identique
    if ($isOk) {
        //tu prend l'email indiquer
        $_SESSION['email'] = $users->email;
        // Puis tu fais appel a la methode getUsers() pour hydrater et donc remplir les sessions
        $users->getUsers();
        $_SESSION['id'] = $users->id;
        $_SESSION['lastName'] = $users->lastName;
        $_SESSION['lastName'] = $users->lastName;
        $_SESSION['firstName'] = $users->firstName;
        $_SESSION['firstPhoneNumber'] = $users->firstPhoneNumber;
        $_SESSION['secondPhoneNumber'] = $users->secondPhoneNumber;
        $_SESSION['postalCode'] = $users->postalCode;
        $_SESSION['birthDate'] = $users->birthDate;
        $_SESSION['address'] = $users->address;
        $_SESSION['city'] = $users->city;
        $_SESSION['society'] = $users->society;
        $_SESSION['describeSociety'] = $users->describeSociety;
        $_SESSION['id_taxi_group'] = $users->id_taxi_group;
    } else {
        //sinon il y a une erreur
        $error = true;
    }
    //envoie l'erreur à login.js
    echo json_encode(array('error' => $error));
}
// Les message de reussite de l'inscription et de la modification
$message = '';
if (isset($_GET['message_reussite'])) {
    return $message = REGISTER_SUCCESS_SEND;
}
if (isset($_GET['modification_reussite'])) {
    return $message = $message = REGISTER_SUCCESS_UPDATE;
    ;
}
// la deconnexion.
$users = new users();
if (isset($_POST['logOut'])) {
    session_unset();
    session_destroy();
}
    