<?php

/**
 * Modèle de la table group.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class booking extends database {

    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $placeOfDeparture = '';
    public $postalCodeDeparture = '';
    public $addressPlaceOfDeparture = '';
    public $arrivalPoint = '';
    public $postalCodeArrivalPoint = '';
    public $addressArrivalPoint = '';
    public $timeOfArrival = '';
    public $dateOfDepartur = '';
    public $id_taxi_users = 0;
    public $id_taxi_booked = 0;

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    public function addBooking() {
        $queryResult = $this->pdo->prepare('INSERT INTO `taxi_booking`(`placeOfDeparture`, `postalCodeDeparture`, `addressPlaceOfDeparture`, `arrivalPoint`, `postalCodeArrivalPoint`, `addressArrivalPoint`, `timeOfArrival`, `dateOfDepartur`, `id_taxi_users`, `id_taxi_booked`) VALUES (:placeOfDeparture, :postalCodeDeparture, :addressPlaceOfDeparture, :arrivalPoint, :postalCodeArrivalPoint, :addressArrivalPoint, CONCAT(:timeOfArrival,\':00\'), STR_TO_DATE(:dateOfDepartur, \'%d/%m/%Y\'), :id_taxi_users, :id_taxi_booked)');
        $queryResult->bindValue(':placeOfDeparture', $this->placeOfDeparture, PDO::PARAM_STR);
        $queryResult->bindValue(':postalCodeDeparture', $this->postalCodeDeparture, PDO::PARAM_STR);
        $queryResult->bindValue(':addressPlaceOfDeparture', $this->addressPlaceOfDeparture, PDO::PARAM_STR);
        $queryResult->bindValue(':arrivalPoint', $this->arrivalPoint, PDO::PARAM_STR);
        $queryResult->bindValue(':postalCodeArrivalPoint', $this->postalCodeArrivalPoint, PDO::PARAM_STR);
        $queryResult->bindValue(':addressArrivalPoint', $this->addressArrivalPoint, PDO::PARAM_STR);
        $queryResult->bindValue(':timeOfArrival', $this->timeOfArrival, PDO::PARAM_STR);
        $queryResult->bindValue(':dateOfDepartur', $this->dateOfDepartur, PDO::PARAM_STR);
        $queryResult->bindValue(':id_taxi_users', $this->id_taxi_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_taxi_booked', $this->id_taxi_booked, PDO::PARAM_INT);
        return $queryResult->execute();
    }
    public function getOrganizerById() {
        $query = 'SELECT `taxi_booking`.`placeOfDeparture`'
                . ', `taxi_booking`.`postalCodeDeparture`'
                . ', `taxi_booking`.`addressPlaceOfDeparture`'
                . ', `taxi_booking`.`arrivalPoint`'
                . ', `taxi_booking`.`postalCodeArrivalPoint`'
                . ', `taxi_booking`.`addressArrivalPoint`'
                . ', `taxi_booking`.`timeOfArrival`'
                . ', `taxi_booking`.`dateOfDepartur`'
                . ', `taxi_users`.`firstName`'
                . ', `taxi_users`.`lastName` '
                . 'FROM `taxi_booking` '
                . 'INNER JOIN `taxi_users` '
                . 'ON `taxi_booking`.`id_taxi_users` = `taxi_users`.`id` '
                . 'WHERE `taxi_booking`.`id_taxi_booked` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
}
