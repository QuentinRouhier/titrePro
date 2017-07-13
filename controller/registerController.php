<?php

//Si la session n'est pas vide donc quelqu'un est conneter
if (!empty($_SESSION)) {
    //Instanciation de la classe location
    $location = new location();
    //appel de la méthode getPostalCodeBySearch pour pouvoir construire la liste déroulante
    // et afficher le bon code postal lors de la modification du profil
    $locationsList = $location->getPostalCodeBySearch($_SESSION['postalCode']);
}


if (isset($_POST['search'])) {
    //Tu inclus les fichier dans le bonne ordre
    include_once '../configuration.php';
    include_once '../class/database.php';
    include_once '../model/location.php';
    //Instanciation de la classe location
    $location = new location();
    $search = $_POST['search'];
    $result = $location->getPostalCodeBySearch($search);
    echo json_encode(array('response' => $result));
} else {
    //Instanciation de la classe group
    $group = new group();
    //appel de la méthode getListGroup pour pouvoir construire la liste déroulante
    $groupList = $group->getListGroup();
    //Instanciation de la classe users
    $users = new users();
    // Les regex de l'inscription
    $regexName = '/^[a-z]([a-zàéèëêù\'ïîâäöôç\- ])+$/i';
    $regexDate = '/((0[1-9])|([1-2][0-9])|(3[0-1]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(20(([0-4][0-9])|(50))))/';
    $regexPhone = '/^0[1-79](\.\d{2}){4}$/i';
    $regexPostalCode = '/^[0-9]{5}$/i';
    $regexEmail = '/^[\w\-\.]+[a-z0-9]@[\w\-\.]+[a-z0-9]\.[a-z]{2,}/i';
    $regexMax100Characters = '/^([a-z0-9àéèëêù\'ïîâäöôç\- ]){3,100}$/i';
    $regexMax150Characters = '/^(.){3,500}$/i';
    // si userError est true erreur dans le mot de passe
    $userError = false;
    //Déclaration d'un tableau d'erreur
    $errorList = array();
    $message = '';
    // Si le boutton register est isset passe a l'etape suivante
    if (isset($_POST['register'])) {
        // Quand tu clic sur le select qui a pour name="group".
        if (isset($_POST['group'])) {
            // Il recupere l'id envoyé par le foreach
            $users->id_taxi_group = strip_tags($_POST['group']);
        }
        // Si la session n'est pas vide.
        if (!empty($_SESSION)) {
            //Il va recuperer l'id pour pouvoir modifié la bonne personne.
            $users->id = intval($_SESSION['id']);
        }
        // Si la value du select = 1 alors :
        if (isset($_POST['group']) && $_POST['group'] == 1) {
            // Si l'input n'est pas vide 
            if (!empty($_POST['society'])) {
                // Tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $users->society = strip_tags($_POST['society']);
                //Si la regex ne match pas
                if (!preg_match($regexMax100Characters, $users->society)) {
                    //tu mets une erreur
                    $errorList['society'] = REGISTER_ERROR_SOCIETY;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['society'] = REGISTER_EMPTY_VALUE;
            }
            // Si l'input n'est pas vide 
            if (!empty($_POST['describeSociety'])) {
                // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
                $users->describeSociety = strip_tags($_POST['describeSociety']);
                //Si la regex ne match pas
                if (!preg_match($regexMax150Characters, $users->describeSociety)) {
                    //Tu mets une erreur
                    $errorList['describeSociety'] = REGISTER_ERROR_DESCRIBESOCIETY;
                }
                //Sinon tu mets une erreur
            } else {
                $errorList['describeSociety'] = REGISTER_EMPTY_VALUE;
            }
            // Sinon tu mets NULL dans les attributs
        } else {
            $users->society = NULL;
            $users->describeSociety = NULL;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['lastName'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->lastName = strip_tags($_POST['lastName']);
            //Si la regex ne match pas
            if (!preg_match($regexName, $users->lastName)) {
                //Tu mets une erreur
                $errorList['lastName'] = REGISTER_ERROR_LASTNAME;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['lastName'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['firstName'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->firstName = strip_tags($_POST['firstName']);
            //Si la regex ne match pas
            if (!preg_match($regexName, $users->firstName)) {
                //Tu mets une erreur
                $errorList['firstName'] = REGISTER_ERROR_FIRSTNAME;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['firstName'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['firstPhoneNumber'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->firstPhoneNumber = strip_tags($_POST['firstPhoneNumber']);
            $users->secondPhoneNumber = strip_tags($_POST['secondPhoneNumber']);
            //Si la regex ne match pas
            if (!preg_match($regexPhone, $users->firstPhoneNumber)) {
                //Tu mets une erreur
                $errorList['firstPhoneNumber'] = REGISTER_ERROR_PHONENUMBER;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['firstPhoneNumber'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['secondPhoneNumber'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->secondPhoneNumber = strip_tags($_POST['secondPhoneNumber']);
            //Si la regex ne match pas
            if (!preg_match($regexPhone, $users->secondPhoneNumber)) {
                //Tu mets une erreur
                $errorList['secondPhoneNumber'] = REGISTER_ERROR_PHONENUMBER;
            }
            //Sinon tu mets une erreur
        } else {
            $users->secondPhoneNumber = NULL;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['postalCode'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->postalCode = strip_tags($_POST['postalCode']);
            //Si la regex ne match pas
            if (!preg_match($regexPostalCode, $users->postalCode)) {
                //Tu mets une erreur
                $errorList['postalCode'] = REGISTER_ERROR_POSTALCODE;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['postalCode'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['city'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->city = strip_tags($_POST['city']);
            //Sinon tu mets une erreur
        } else {
            $errorList['city'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['address'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->address = strip_tags($_POST['address']);
            //Si la regex ne match pas
            if (!preg_match($regexMax100Characters, $users->address)) {
                //Tu mets une erreur
                $errorList['address'] = REGISTER_ERROR_ADDRESS;
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['address'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['birthDate'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->birthDate = strip_tags($_POST['birthDate']);
            //Sinon tu mets une erreur
        } else {
            $errorList['address'] = REGISTER_EMPTY_VALUE;
        }
        // Si l'input n'est pas vide
        if (!empty($_POST['email'])) {
            // tu passe en POST la value qui es de dans puis tu le mets dans l'attribut correspondant
            $users->email = strip_tags($_POST['email']);
            //Si la regex ne match pas
            if (!preg_match($regexEmail, $users->email)) {
                //Tu mets une erreur
                $errorList['email'] = REGISTER_ERROR_ADDRESS;
                //Sinon tu regarde si l'email est utiliser
            } else {
                //Si il est egale a 1 l'email est deja utiliser
                if (empty($_SESSION) && $users->checkUser() == 1) {
                    //Tu mets un message d'erreur 
                    $errorList['email'] = REGISTER_DUPLICATE_ADDRESS;
                }
            }
            //Sinon tu mets une erreur
        } else {
            $errorList['email'] = REGISTER_EMPTY_VALUE;
        }
        //Si le mots de passe n'est pas vide et que la confirmation du mot de passe non plus et qu'il sont identique.
        if (!empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['password'] == $_POST['confirmPassword']) {
            //Tn stocke dans l'attribut password de l'objet users, la version chiffrée du mot de passe
            //On chiffre le mot de passe avec la fonction password_hash qui prend en paramètre le mot de passe envoyée et la méthode de chiffrement 
            $users->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            //Si un des $_POST est vide ou que les mots de passes ne sont pas identiques, on passe $userError à true (nous permet d'afficher notre message d'erreur dans la vue)
            $userError = true;
            $errorList['confirmPassword'] = REGISTER_ERROR_PASSWORD;
        }
        //On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
        if (count($errorList) == 0) {
            // Si il y a quelqu'un de connecter donc que la session n'est pas vide tu passe a l'étape suivante.
            if (!empty($_SESSION)) {
                //Si PDO renvoie une erreur on le signale à l'utilisateur
                if (!$users->updateUser()) {
                    //Tu affiche une erreur
                    $message = REGISTER_ERROR_UPDATE;
                    //Sinon tu redirige la page sur l'index
                } else
                    header('Location: index.php?modification_reussite');
                exit;
            }
        } else {
            //Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$users->addUser()) {
                //Tu affiche une erreur
                $message = REGISTER_ERROR_SEND;
                //Sinon tu redirige la page sur l'index
            } else {
                header('Location: index.php?message_reussite');
                exit;
            }
        }
    }
}
// Si le boutton delete est isset
if (isset($_POST['delete'])) {
    //tu prend l'id de la perssone
    $users->id = intval($_SESSION['id']);
    //Tu va chercher la methode deleteUser() dans l'objet users
    $users->deleteUser();
    // Tu decconect la personne
    session_unset();
    session_destroy();
    //Tu la redirige sur l'index
    header('Location: index.php');
    exit;
}