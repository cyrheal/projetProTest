<?php

class performance extends database {

//Création d'attributs qui correspondent à chacun des champs de la table c3005_preformance
//et on les initialise par rapport à leurs types.
    public $id;
    public $descriptive = '';
    public $price = '';

//On appelle le __construct() du parent via parent::
    function construct() {
        parent::construct();
    }

    /**
     * Méthode pour afficher le prix et la prestation (adminController et appointmentChangeController)
     * @return type array
     */
    public function getPriceByPerformance() {
        $result = array();
//On met notre requète dans la variable $query qui selectionne les champs de la table c3005_performance
        $query = 'SELECT `id`, `descriptive`,`price` FROM `c3005_performance` ORDER BY `id`';
//On crée un objet $queryResult qui exécute la méthode query() avec comme paramètre $query
        $queryResult = $this->db->query($query);
//Si $queryResult est un objet, on affiche un tableau d'objet de toutes les données de la requête via le paramètre (PDO::FETCH_OBJ)
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

}

?>
