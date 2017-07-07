<?php

class users extends database {

    public $id = 0;
    public $firstName = '';
    public $lastName = '';
    public $firstPhoneNumber = '';
    public $secondPhoneNumber = '';
    public $postalCode = '';
    public $birthDate = '01/01/1900';
    public $address = '';
    public $place = '';
    public $society = '';
    public $email = '';
    public $password = '';
    public $id_taxi_group = 0;

    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    public function addUser() {
        $query = 'INSERT INTO `taxi`.`taxi_users` (`id`, `lastName`, `firstName`, `firstPhoneNumber`, `secondPhoneNumber`, `postalCode`, `birthDate`, `address`, `place`, `society`, `email`, `password`, `id_taxi_group`) VALUES (NULL, UPPER(:lastName), :firstName, REPLACE(:firstPhoneNumber, \'.\',\'\'), REPLACE(:secondPhoneNumber, \'.\',\'\'), :postalCode ,STR_TO_DATE(:birthDate, \'%d/%m/%Y\'), :address, :place, :society, :email, :password, :id_taxi_group)';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstPhoneNumber', $this->firstPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':secondPhoneNumber', $this->secondPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':postalCode', $this->postalCode, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':place', $this->city, PDO::PARAM_STR);
        $queryResult->bindValue(':society', $this->society, PDO::PARAM_STR);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_taxi_group', $this->id_taxi_group, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function getHashByUser() {
        $isOk = false;
        $query = 'SELECT `password` FROM `taxi_users` WHERE `email` = :email';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        //Si la requête s'éxecute sans erreur
        if ($queryResult->execute()) {
            //On récupère le hash
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
            //Si resulte est un objet (donc si on a récupéré et stocké notre résultat dans result)
            if (is_object($result)) {
                //On donne à l'attribut de notre objet créé dans le controller la valeur de l'attribut password de notre objet resultat
                $this->password = $result->password;
                //On passe notre variable à true, pour dire qu'il n'y a pas d'erreur
                $isOk = true;
            }
        }
        //Si $isOk est à false, aucune condition n'est remplie, il y a une erreur, on pourra afficher un message
        //Si elle est à true, toutes les conditions sont remplies est on pourra éxécuter la suite
        return $isOk;
    }

    public function getUsers() {
        $query = 'SELECT `id`,`lastName`, `firstName`, `firstPhoneNumber`, `secondPhoneNumber`, `postalCode`, `birthDate`, `address`, `place`, `society`, `email`, `id_taxi_group` FROM taxi_users WHERE email = :email';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryResult->execute();
        $result = $queryResult->fetch(PDO::FETCH_OBJ);
        $this->id = $result->id;
        $this->lastName = $result->lastName;
        $this->firstName = $result->firstName;
        $this->firstPhoneNumber = $result->firstPhoneNumber;
        $this->secondPhoneNumber = $result->secondPhoneNumber;
        $this->postalCode = $result->postalCode;
        $this->birthDate = $result->birthDate;
        $this->address = $result->address;
        $this->place = $result->place;
        $this->society = $result->society;
        $this->id_taxi_group = $result->id_taxi_group;
    }

}
