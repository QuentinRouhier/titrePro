<?php
// varriable $error qui ne contient car il n'y a pas eu d'erreur
$error = '';
// Instanciation de la classe users
$users = new users();
// Si le boutton delete est isset
if (isset($_POST['delete'])) {
    // on recupere le mots de passe qui a ecrit
    $password = strip_tags($_POST['password']);
    //Puis on donne à l'attribut email de l'objet users, la valeur de la varriable de session email
    $users->email = $_SESSION['email'];
    // Avec la methode getHashByUser on recuperent  le mot de passe de l'email
    $users->getHashByUser();
    //password_verify Vérifie que le  mot de passe correspond au hachage .
    $isOk = password_verify($password, $users->password);
    //Si c'est bon
    if ($isOk) {
        //tu prend l'id de la perssone
        $users->id = intval($_SESSION['id']);
        //Tu va chercher la methode deleteUser() dans l'objet users
        $users->deleteUser();
        //Détruit toutes les variables d'une session
        session_unset();
        //Détruit la session
        session_destroy();
        //Tu la redirige sur l'accueil avec en parrametre d ainsi afficher le bon message
        header('Location: /accueil?d');
        //On s'assure que la suite du code ne soit pas exécutée une fois la redirection effectuée.
        exit;
        //si le mot de passe n'est pas le bon on affiche une erreur
    }else{
        $error = FALSE_PSW;
    }
}