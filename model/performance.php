<?php

class performance extends database {

    public $id;
    public $descriptive = '';
    public $price = '';
  

function construct() {
        parent::construct();
    }
    public function getPriceByPerformance() {
        //faut renomer birthDate avec le AS car le birthDate et entre parenthèse
        $query = 'SELECT `id`, `descriptive`,`price` FROM `c3005_performance` ORDER BY `id`';
        //permet d executer une requete sql this= $db 
        $queryResult = $this->db->query($query);
        //un tableau d'objets fecth(recherche) obj
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
}

?>
