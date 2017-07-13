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
}