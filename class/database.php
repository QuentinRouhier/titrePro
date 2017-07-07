<?php

/**
 * Classe permettant de se connecter à la base de données.
 * Ses enfants hériterons de ses méthodes et attributs et protected ou public.
 */
class database {

    /**
     * Déclaration des attributs de connexion à la base de données
     */
    private $login = '';
    private $pwd = '';
    private $db = '';
    private $host = '';

    /**
     * Déclaration de l'attribut pdo
     */
    protected $pdo;

    /**
     * Constructeur de la classe parente 
     * On a rempli les attributs avec des constantes grâce au mot clé $this.
     */
    protected function __construct() {
        $this->login = LOGIN;
        $this->pwd = PWD;
        $this->db = DB;
        $this->host = HOST;
    }

    /**
     * Déclaration de la méthode qui va permettre la connexion à la base de données.
     * On se sert de la classe PDO de PHP. On met un try catch pour attrapper une erreur si il y a.
     */
    public function connectDB() {
        try {
            $this->pdo = new PDO('mysql:host=' . $this->host . ';dbname=' . $this->db . ';charset=utf8', $this->login, $this->pwd);
        }
// Si il y a une erreur on "attrape" l'exception dans $e et on affiche un message d'erreur
        catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
    }

}
