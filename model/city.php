<?php

class city extends database {

//Création d'attributs qui correspondent à chacun des champs de la table c3005_city
//et on les initialise par rapport à leurs types.
    public $id = 0;
    public $city = '';
    public $zipcode = '';

//On appelle le __construct() du parent via parent::
    function construct() {
        parent::construct();
    }

    /**
     * Méthode pour afficher la liste des villes (accountController et registerController)
     * @return type array
     */
    public function getCityList() {
        $result = array();
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_city
        $query = 'SELECT `id`, `city` FROM `c3005_city` ORDER BY `city`';
//On crée un objet $queryResult qui exécute la méthode query() avec comme paramètre $query
        $queryResult = $this->db->query($query);
//On affiche un tableau d'objet de toutes les données de la requête via le paramètre (PDO::FETCH_OBJ)
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode pour afficher la liste des codes postaux (accountController et registerController)
     * @return type array
     */
    public function getZipcodeList() {
        $result = array();
//On met notre requète dans la variable $query qui selectionne un champ de la table c3005_city
        $query = 'SELECT `zipcode` FROM `c3005_city` GROUP BY `zipcode`';
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }
/**
 * Méthode pour récupérer la ville en fonction de l id 
 * @return type array
 */
    public function getCityById() {
        $result = FALSE;
        $query = 'SELECT `city` FROM `c3005_city` WHERE `id`=:id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//On crée un objet $result qui affichera la ville grâce à la fonction fetch
//via le paramètre (PDO::FETCH_OBJ) si la méthode est exécuté
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }
}

?>
