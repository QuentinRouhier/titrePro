<?php
/**
 * Modèle de la table group.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class group extends database {
    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $name = '';
     /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }
    /**
     * Methode permetant de selectionner id et le name de la table taxi_group.
     */
    public function getListGroup() {
        $queryResult = $this->pdo->query('SELECT `t_grp`.`name`,`t_grp`.`id` FROM `taxi_group` AS `t_grp`');
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}