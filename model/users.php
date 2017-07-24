<?php

/**
 * Modèle de la table users.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class users extends database {

    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $firstName = '';
    public $lastName = '';
    public $firstPhoneNumber = '';
    public $secondPhoneNumber = '';
    public $address = '';
    public $society = '';
    public $describeSociety = '';
    public $email = '';
    public $birthDate = '01/01/1900';
    public $password = '';
    public $id_taxi_group = 0;
    public $id_taxi_location = 0;
    public $postalCode = '';

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    /**
     * Methode permetant d'ajouter un utilisateur.
     */
    public function addUser() {
        $query = 'INSERT INTO `taxi_users` (`id`, `lastName`, `firstName`, `firstPhoneNumber`, `secondPhoneNumber`, `birthDate`, `address`,`society`, `describeSociety`, `email`, `password`, `id_taxi_group`,`id_taxi_location`) VALUES (NULL, UPPER(:lastName), :firstName, REPLACE(:firstPhoneNumber, \'.\',\'\'), REPLACE(:secondPhoneNumber, \'.\',\'\'),STR_TO_DATE(:birthDate, \'%d/%m/%Y\'), :address, :society, :describeSociety, :email, :password, :id_taxi_group, :id_taxi_location)';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstPhoneNumber', $this->firstPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':secondPhoneNumber', $this->secondPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':society', $this->society, PDO::PARAM_STR);
        $queryResult->bindValue(':describeSociety', $this->describeSociety, PDO::PARAM_STR);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_taxi_group', $this->id_taxi_group, PDO::PARAM_INT);
        $queryResult->bindValue(':id_taxi_location', $this->id_taxi_location, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * méthode permettant de récupérer le hash en fonction du login
     */
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

    /**
     * méthode permettant de selectionner un utilisateur.
     */
    public function getUsers() {
        $query = 'SELECT `id`,`lastName`, `firstName`, `firstPhoneNumber`, `secondPhoneNumber`, `birthDate`, `address`, `society`, `describeSociety`, `email`, `id_taxi_group`,`id_taxi_location` FROM taxi_users WHERE email = :email';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryResult->execute();
        $result = $queryResult->fetch(PDO::FETCH_OBJ);
        $this->id = $result->id;
        $this->lastName = $result->lastName;
        $this->firstName = $result->firstName;
        $this->firstPhoneNumber = $result->firstPhoneNumber;
        $this->secondPhoneNumber = $result->secondPhoneNumber;
        $this->birthDate = $result->birthDate;
        $this->address = $result->address;
        $this->society = $result->society;
        $this->describeSociety = $result->describeSociety;
        $this->id_taxi_group = $result->id_taxi_group;
        $this->id_taxi_location = $result->id_taxi_location;
    }

    /**
     * méthode permettant de verifier si un email existe deja.
     */
    public function checkUser() {
        $select = 'SELECT COUNT(*) AS `exists` FROM `taxi_users` WHERE `email` = :email';
        $queryPrepare = $this->pdo->prepare($select);
        $queryPrepare->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryPrepare->execute();
        $result = $queryPrepare->fetch(PDO::FETCH_OBJ);
        return $result->exists;
    }

    /**
     * méthode permettant de supprimer un utilisateur par rapport a son id.
     */
    public function deleteUser() {
        $query = 'DELETE FROM `taxi_users` WHERE `id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * méthode permettant de modifier un utilisateur.
     */
    public function updateUser() {
        $query = 'UPDATE `taxi_users` SET `lastName` = UPPER(:lastName), `firstName` = :firstName, `firstPhoneNumber` = REPLACE(:firstPhoneNumber, \'.\',\'\'), `secondPhoneNumber` = REPLACE(:secondPhoneNumber, \'.\',\'\'), `birthDate` = STR_TO_DATE(:birthDate, \'%d/%m/%Y\'), `address` = :address, `society` = :society, `describeSociety` = :describeSociety, `email` = :email, `password` = :password, `id_taxi_location` = :id_taxi_location ,`id_taxi_group` = :id_taxi_group WHERE id = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':lastName', $this->lastName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstName', $this->firstName, PDO::PARAM_STR);
        $queryResult->bindValue(':firstPhoneNumber', $this->firstPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':secondPhoneNumber', $this->secondPhoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':birthDate', $this->birthDate, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':society', $this->society, PDO::PARAM_STR);
        $queryResult->bindValue(':describeSociety', $this->describeSociety, PDO::PARAM_STR);
        $queryResult->bindValue(':email', $this->email, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_taxi_group', $this->id_taxi_group, PDO::PARAM_INT);
        $queryResult->bindValue(':id_taxi_location', $this->id_taxi_location, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function searchTaxiByPostalCodeDeparture() {
        $query = 'SELECT `taxi_users`.`firstName`'
                . ',`taxi_users`.`id`'
                . ',`taxi_users`.`lastName`'
                . ',`taxi_users`.`firstPhoneNumber`'
                . ',`taxi_users`.`secondPhoneNumber`'
                . ',`taxi_users`.`address`'
                . ',`taxi_users`.`society`'
                . ',`taxi_users`.`describeSociety`'
                . ',`taxi_users`.`email`'
                . ',`taxi_location`.`postalCode`'
                . 'FROM `taxi_users` '
                . 'INNER JOIN `taxi_location` '
                . 'ON `taxi_users`.`id_taxi_location` = `taxi_location`.`id` '
                . 'WHERE `taxi_location`.`postalCode` LIKE :postalCode AND `taxi_users`.`id_taxi_group` = 1';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':postalCode', $this->postalCode . '%', PDO::PARAM_STR);
        $queryResult->execute();
        $result = $queryResult->fetchALL(PDO::FETCH_OBJ);
        return $result;
    }

    public function GetCityAndPostalCode() {
        $query = 'SELECT `taxi_users`.`firstName`'
                . ',`taxi_location`.`city`'
                . ',`taxi_location`.`postalCode` '
                . 'FROM `taxi_users` '
                . 'INNER JOIN `taxi_location` '
                . 'ON `taxi_users`.`id_taxi_location` = `taxi_location`.`id` '
                . 'WHERE `taxi_users`.`id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchALL(PDO::FETCH_OBJ);
        return $result;
    }

}
