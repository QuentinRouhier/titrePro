<?php

class group extends database {
    public $id = 0;
    public $name = '';
    
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    
    public function getListGroup() {
        $queryResult = $this->pdo->query('SELECT `t_grp`.`name`,`id` FROM `taxi_group` AS `t_grp`');
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}