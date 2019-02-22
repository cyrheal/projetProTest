<?php

class client extends database {

    public $id = 0;
    public $firstname = '';
    public $lastname = '';
    public $mail = '';
    public $address = '';
    public $phoneNumber = '0000000000';
    public $password = '';
    public $loyaltyPoint = 0;
    public $id_c3005_role = 0;
    public $id_c3005_city = 0;

    function construct() {
        parent::construct();
    }

    /*     * ****************************CRUD CLIENT********************* */

    /**
     * Ajouter un client (1)
     * @return type
     */
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

    //
    /**
     * méthode qui récupère les infos utiles de l'utilisateur après sa connection et affiche le profil du client (3)
     * @return type
     */
    public function getProfilclient() {
        $query = 'SELECT `c3005_user`.`id` AS `idUser`, `firstname`, `lastname`, `mail`, `phoneNumber`, `address`, `city`, `zipcode`, `loyaltyPoint`, `id_c3005_role` FROM `c3005_user` LEFT JOIN `c3005_city` ON `c3005_city`.`id` = `c3005_user`.`id_c3005_city` WHERE `c3005_user`.`mail`=:mail';
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
        $query = 'UPDATE `c3005_user` SET `firstname` = :firstname, `lastname` = :lastname, `mail` = :mail, `address` = :address, `phoneNumber` = :phoneNumber, `password` = :password, `id_c3005_city` = :id_c3005_city WHERE `c3005_user`.`id` = :id';
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
     * méthode pour la suppression d'un client 
     * @return type
     */
    public function deleteClientById() {
        $query = 'DELETE FROM `c3005_user` WHERE `c3005_user`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        // on attribue les valeurs avec bindValue et on recupère les attributs avec $this
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

    /*     * ****************************CRUD CLIENT fin********************* */

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
    /*     * ****************************CRUD rendez-vous ********************* */

    //affiche le nom et le prénom dans la liste déroulante des rendez-vous (2)
    public function getClientList() {
        //faut renomer birthDate avec le AS car le birthDate et entre parenthèse
        $query = 'SELECT `id`, `lastname`, `firstname` FROM `c3005_user` ORDER BY `lastname`';
        //permet d executer une requete sql this= $db 
        $queryResult = $this->db->query($query);
        //un tableau d'objets fecth(recherche) obj
        return $queryResult->fetchAll(PDO::FETCH_OBJ);
    }

    //affiche le profil du patient en cliquant sur profil (3) changer la requete
    public function getProfilClientAdmin() {
        $return = FALSE;
//        $isOk = FALSE;
        $query = 'SELECT `c3005_user`.`id`, `firstname`, `lastname`, `mail`, `phoneNumber`, `address`, `city`, `zipcode`, `loyaltyPoint`, `id_c3005_role` FROM `c3005_user` LEFT JOIN `c3005_city` ON `c3005_city`.`id` = `c3005_user`.`id_c3005_city` WHERE `c3005_user`.`id`=:id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//si la requete c'est bien executé alors on rempli $returnArray avec un objet         
        if ($queryResult->execute()) {
            $return = $queryResult->fetch(PDO::FETCH_OBJ);
        }
////si $return est un objet alors on hydrate       
//        if (is_object($return)) {
//            $this->id = $return->id;
//            $this->lastname = $return->lastname;
//            $this->firstname = $return->firstname;
//            $this->mail = $return->mail;
//            $this->address = $return->address;
//            $this->city = $return->city;
//            $this->zipcode = $return->zipcode;
//            $this->phoneNumber = $return->phoneNumber;
//            $this->loyaltyPoint = $return->loyaltyPoint;
//            $isOk = TRUE;
//        }
        return $return;
    }

}
