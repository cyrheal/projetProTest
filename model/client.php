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
    public $id_c3005_role = 0;
    public $id_c3005_city = 0;
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
        $query = 'INSERT INTO `c3005_user` (`firstname`, `lastname`, `mail`, `address`, `phoneNumber`, `password`, `id_c3005_city`)
                  VALUES (:firstname, :lastname,  :mail, :address, :phoneNumber, :password, :id_c3005_city);';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
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

    //affiche le profil du client et la session (3)
    public function getProfilclient() {
        $query = 'SELECT * FROM `c3005_user` LEFT JOIN `c3005_city` ON `c3005_city` . `id` = `c3005_user` . id_c3005_city WHERE `c3005_user`.`mail`=:mail';
        $result = $this->db->prepare($query);
        $result->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $result->execute();
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetch(PDO::FETCH_OBJ);
        return $resultList;
    }

//    modifie les coordonnées (4)
    public function updateClient() {
        $query = 'UPDATE `c3005_user` SET `firstname` = :firstname, `lastname` = :lastname, `mail` = :mail, `address` = :address, `phoneNumber` = :phoneNumber, `password` = :password, `id_c3005_city` = :id_c3005_city WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_city', $this->id_c3005_city, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }
    /**
     * méthode pour  permettre la suppression d'un client 
     * @return type
     */
 public function deleteClientById() {
        $query = 'DELETE FROM `c3005_user` WHERE `id` = :id';
        $queryResult = $this->db->prepare($query);
        // on attribue les valeurs avec bindValue et on recupère les attributs avec $this
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
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

    /**
     * Méthode qui récupère les infos utiles de l'utilisateur après sa connection
     * @return type
     */
//    function getUserInfo() {
//        $query = 'SELECT * FROM `c3005_user` WHERE `mail` = :mail';
//        $result = $this->db->prepare($query);
//        $result->bindValue(':mail', $this->mail, PDO::PARAM_STR);
//        $result->execute();
//        return $result->fetch(PDO::FETCH_OBJ);
//    }

}

?>  