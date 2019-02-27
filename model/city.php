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
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_city
        $query = 'SELECT `id`, `city` FROM `c3005_city` ORDER BY `city`';
//On crée un objet $queryResult qui exécute la méthode query() avec comme paramètre $query
        $queryResult = $this->db->query($query);
//On affiche un tableau d'objet de toutes les données de la requête via le paramètre (PDO::FETCH_OBJ)
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
    
    /**
     * Méthode pour afficher la liste des codes postaux (accountController et registerController)
     * @return type array
     */
    public function getZipcodeList() {
//On met notre requète dans la variable $query qui selectionne un champ de la table c3005_city
        $query = 'SELECT `zipcode` FROM `c3005_city` GROUP BY `zipcode`';
        $queryResult = $this->db->query($query);
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}

?>
