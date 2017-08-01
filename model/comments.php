<?php

/**
 * Modèle de la table users.
 * Ce modèle est la réplique de la table.
 * Ici je la déclare
 * Le mot clé extends permet de dire que la classe users hérite de la classe database
 */
class comments extends database {

    /**
     * Déclaration des champs de la table en attribut.
     * Dans une classe les variables globales sont appelées attributs
     * @var type 
     */
    public $id = 0;
    public $content = '';
    public $publishDate = '';
    public $id_taxi_users = 0;
    public $id_taxi_booking = 0;

    /**
     * Déclaration de la méthode magique construct.
     * Le constructeur de la classe est appelé avec le mot clé new.
     */
    public function __construct() {
        parent::__construct();
        $this->connectDB();
    }

    /**
     *  Fonction qui permet d'ajouter un commentaire dans la base de données
     */
    public function addComment() {
        $query = 'INSERT INTO `taxi_comments` (`content`, `publishDate`, `id_taxi_users`, `id_taxi`) '
                . 'VALUES (:content, NOW(), :id_taxi_users, :id_taxi)';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':content', $this->content, PDO::PARAM_STR);
        $queryResult->bindValue(':id_taxi_users', $this->id_taxi_users, PDO::PARAM_INT);
        $queryResult->bindValue(':id_taxi', $this->id_taxi, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    public function getComment() {
        $query = 'SELECT `taxi_comments`.`content` '
                . ', `taxi_comments`.`publishDate` '
                . ',`taxi_comments`.`id` '
                . ',`taxi_users`.`firstName` '
                . ',`taxi_users`.`lastName` '
                . ',`taxi_users`.`id` as `userId` '
                . 'FROM `taxi_comments` '
                . 'INNER JOIN `taxi_users` '
                . 'ON `taxi_comments`.`id_taxi_users` = `taxi_users`.`id` '
                . 'WHERE `taxi_comments`.`id_taxi` = :id ';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        return $result;
    }
    public function deleteComment() {
        $query = 'DELETE FROM `taxi_comments` WHERE `taxi_comments`.`id` = :id';
        $queryResult = $this->pdo->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
