<?php

if (isset($_POST['search'])) {
    include_once '../configuration.php';
    include_once '../class/database.php';
    include_once '../model/location.php';
    $location = new location();
    $search = $_POST['search'];
    $result = $location->getPostalCodeBySearch($search);
    echo json_encode(array('response' => $result));
} else {
    $group = new group();

    $groupList = $group->getListGroup();

    $users = new users();

    $regexName = '/^[a-z]([a-zàéèëêù\'ïîâäöôç\- ])+$/i';
    $regexDate = '/((0[1-9])|([1-2][0-9])|(3[0-1]))\/((0[1-9])|(1[0-2]))\/((19[0-9]{2})|(20(([0-4][0-9])|(50))))/';
    $regexPhone = '/^0[1-79](\.\d{2}){4}$/i';
    $regexPostalCode = '/^[0-9]{5}$/i';
    $regexEmail = '/^[\w\-\.]+[a-z0-9]@[\w\-\.]+[a-z0-9]\.[a-z]{2,}/i';
    $regexMax100Characters = '/^([a-z0-9àéèëêù\'ïîâäöôç\- ]){3,100}$/i';
    $userError = false;
    //déclaration d'un tableau d'erreur
    $errorList = array();
    $message = '';
    if (isset($_POST['register'])) {
        if (isset($_POST['group'])) {
            $users->id_taxi_group = strip_tags($_POST['group']);
        }
        if (isset($_POST['group']) && $_POST['group'] == 1) {
            if (!empty($_POST['society'])) {
                $users->society = strip_tags($_POST['society']);
                if (!preg_match($regexMax100Characters, $users->society)) {
                    $errorList['society'] = REGISTER_ERROR_SOCIETY;
                }
            } else {
                $errorList['society'] = REGISTER_EMPTY_VALUE;
            }
        } else {
            $users->society = NULL;
        }
        if (!empty($_POST['lastName'])) {
            $users->lastName = strip_tags($_POST['lastName']);
            if (!preg_match($regexName, $users->lastName)) {
                $errorList['lastName'] = REGISTER_ERROR_LASTNAME;
            }
        } else {
            $errorList['lastName'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['firstName'])) {
            $users->firstName = strip_tags($_POST['firstName']);
            if (!preg_match($regexName, $users->firstName)) {
                $errorList['firstName'] = REGISTER_ERROR_FIRSTNAME;
            }
        } else {
            $errorList['firstName'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['firstPhoneNumber'])) {
            $users->firstPhoneNumber = strip_tags($_POST['firstPhoneNumber']);
            $users->secondPhoneNumber = strip_tags($_POST['secondPhoneNumber']);
            if (!preg_match($regexPhone, $users->firstPhoneNumber)) {
                $errorList['firstPhoneNumber'] = REGISTER_ERROR_PHONENUMBER;
            }
        } else {
            $errorList['firstPhoneNumber'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['secondPhoneNumber'])) {
            $users->secondPhoneNumber = strip_tags($_POST['secondPhoneNumber']);
            if (!preg_match($regexPhone, $users->secondPhoneNumber)) {
                $errorList['secondPhoneNumber'] = REGISTER_ERROR_PHONENUMBER;
            }
        } else {
            $users->secondPhoneNumber = NULL;
        }
        if (!empty($_POST['postalCode'])) {
            $users->postalCode = strip_tags($_POST['postalCode']);
            if (!preg_match($regexPostalCode, $users->postalCode)) {
                $errorList['postalCode'] = REGISTER_ERROR_POSTALCODE;
            }
        } else {
            $errorList['postalCode'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['city'])) {
            $users->city = strip_tags($_POST['city']);
        } else {
            $errorList['city'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['address'])) {
            $users->address = strip_tags($_POST['address']);
            if (!preg_match($regexMax100Characters, $users->address)) {
                $errorList['address'] = REGISTER_ERROR_ADDRESS;
            }
        } else {
            $errorList['address'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['birthDate'])) {
            $users->birthDate = strip_tags($_POST['birthDate']);
        } else {
            $errorList['address'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['email'])) {
            $users->email = strip_tags($_POST['email']);
            if (!preg_match($regexEmail, $users->email)) {
                $errorList['email'] = REGISTER_ERROR_ADDRESS;
            }
        } else {
            $errorList['email'] = REGISTER_EMPTY_VALUE;
        }
        if (!empty($_POST['password']) && !empty($_POST['confirmPassword']) && $_POST['password'] == $_POST['confirmPassword']) {
            //Si tout va bien, on stocke dans l'attribut password de l'objet user, la version chiffrée du mot de passe
            //On chiffre le mot de passe avec la fonction password_hash qui prend en paramètre le mot de passe envoyée et la méthode de chiffrement (cf PHP.net)
            $users->password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            //Si un des $_POST est vide ou que les mots de passes ne sont pas identiques, on passe $userError à true (nous permet d'afficher notre message d'erreur dans la vue)
            $userError = true;
            $errorList['confirmPassword'] = REGISTER_ERROR_PASSWORD;
        }
        //On compte le nombre de lignes pour savoir si il y a eu une erreur dans la saisie
        if (count($errorList) == 0) {
//Si PDO renvoie une erreur on le signale à l'utilisateur
            if (!$users->addUser()) {
                $message = REGISTER_ERROR_SEND;
            } else {
                $message = REGISTER_SUCCESS_SEND;
            }
        }
    }
}