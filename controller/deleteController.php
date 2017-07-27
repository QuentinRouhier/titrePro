<?php
$error = '';
$users = new users();
// Si le boutton delete est isset
if (isset($_POST['delete'])) {
    $password = strip_tags($_POST['password']);
    $users->email = $_SESSION['email'];
    // Avec la methode getHashByUser on regarde si le mots de passe correspond a celui de l'email
    $users->getHashByUser();
    //password_verify Vérifie que le  mot de passe correspond au hachage .
    $isOk = password_verify($password, $users->password);
    if ($isOk) {
        //tu prend l'id de la perssone
        $users->id = intval($_SESSION['id']);
        //Tu va chercher la methode deleteUser() dans l'objet users
        $users->deleteUser();
        // Tu decconect la personne
        session_unset();
        session_destroy();
        //Tu la redirige sur l'index
        header('Location: /accueil?suppression_reussi');
        exit;
    }else{
        $error = 'le mot de passe est incorect';
    }
}