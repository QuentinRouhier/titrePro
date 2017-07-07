<?php

class location extends database {
    public $id = 0;
    public $postalCode = 0;
    public $city = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    public function getPostalCodeBySearch($search){
        $queryResult = $this->pdo->prepare('SELECT `postalCode`,`id`,`city` FROM `taxi_location` WHERE `postalCode` LIKE :search');
        $queryResult->bindValue(':search',$search.'%',PDO::PARAM_STR);
        $queryResult->execute();
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}