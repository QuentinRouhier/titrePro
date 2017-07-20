<?php
/**
 * Modèle de la table location.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class location extends database {
    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $postalCode = 0;
    public $city = '';
    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    /**
     * Methode permetant de chercher une ville par rapport a son code postal.
     */
    public function getPostalCodeBySearch($search){
        $queryResult = $this->pdo->prepare('SELECT `postalCode`,`id`,`city` FROM `taxi_location` WHERE `postalCode` LIKE :search');
        $queryResult->bindValue(':search',$search.'%',PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
    public function getListLocation($locationId) {
        $queryResult = $this->pdo->prepare('SELECT `t_lct`.`postalCode`,`t_lct`.`city` FROM `taxi_location` AS `t_lct` INNER JOIN `taxi_users` AS `t_usr` ON `t_lct`.`id` = `t_usr`.`id_taxi_location` WHERE `t_usr`.`id_taxi_location` = :locationId');
        $queryResult->bindValue(':locationId',$locationId,PDO::PARAM_INT);
        $queryResult->execute();
        return $queryResult->fetch(PDO::FETCH_OBJ);
    }
    // Quand on fait une reservation affiche les ville de la base de donner
    public function getLocation(){
        $queryResult = $this->pdo->prepare('SELECT `postalCode`,`id`,`city` FROM `taxi_location` WHERE `city` LIKE :city ORDER BY `city` ASC LIMIT 0,10 ');
        $queryResult->bindValue(':city',  $this->city.'%',PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}