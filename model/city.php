<?php

class city {

    public $id = 0;
    public $city = '';
    public $zipcode = '';
    public $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=jessicanailsbeauty;dbname=jessicanailsbeauty;charset=utf8', 'cyril', 'la198677');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }
    public function getCityList() {
        //faut renomer birthDate avec le AS car le birthDate et entre parenthèse
        $query = 'SELECT `id`, `city`,`zipcode` FROM `c3005_city` ORDER BY `city`';
        //permet d executer une requete sql this= $db 
        $queryResult = $this->db->query($query);
        //un tableau d'objets fecth(recherche) obj
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
    public function getZipcodeList() {
        //faut renomer birthDate avec le AS car le birthDate et entre parenthèse
        $query = 'SELECT `zipcode` FROM `c3005_city` GROUP BY `zipcode`';
        //permet d executer une requete sql this= $db 
        $queryResult = $this->db->query($query);
        //un tableau d'objets fecth(recherche) obj
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

}

?>
