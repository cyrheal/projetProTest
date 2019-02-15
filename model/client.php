<?php

class client {

    public $id = 0;
    public $firstName = '';
    public $lastName = '';
    public $mail = '';
    public $address = '';
    public $phoneNumber = '0000000000';
    public $password = '';
    public $loyaltyPoint = 0;
    public $city = '';
    protected $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=jessicanailsbeauty;dbname=jessicanailsbeauty;charset=utf8', 'cyril', 'la198677');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //ajouter un client (1)
    public function addClient() {
        $query = 'INSERT INTO `c3005_user` (`fisrtname`, `lastname`, `mail`, `address`, `phoneNumber`, `password`, `id_c3005_city`)
                  VALUES (:firstname, :lastname,  :mail, :address, :phoneNumber, :password, :id_c3005_city);';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password' , $this->password, PDO::PARAM_STR);            
        $queryResult->bindValue(':id_c3005_city', $this->id_c3005_city, PDO::PARAM_INT);             
        return $queryResult->execute();
    }
    
    
    //afficher la ville et le code postale
    public function getCityList() {
        //faut renomer birthDate avec le AS car le birthDate et entre parenthèse
        $query = 'SELECT `id`, `city`, `zipcode` FROM `c3005_city` ORDER BY `zipcode`';
        //permet d executer une requete sql this= $db 
        $queryResult = $this->db->query($query);
        //un tableau d'objets fecth(recherche) obj
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }
  /**
     * Méthode qui retourne le hashage du mot de passe du compte sélectionné.
     * @return type
     */
    function getHashFromUser() {
        $query = 'SELECT `password` FROM `c3005_user` WHERE `mail` = :mail';
        $result = $this->db->prepare($query);
        $result->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $result->execute();
        return $result->fetch(PDO::FETCH_OBJ);
    }
}

?>  