<?php

class client extends database {

//Création d'attributs qui correspondent à chacun des champs de la table c3005_user
//et on les initialise par rapport à leurs types
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

//On appelle le __construct() du parent via parent::
    function construct() {
        parent::construct();
    }

    /*     ********************CRUD CLIENT*********************      */

    /**
     * Méthode pour créer un nouveau client (registerController)
     * @return execute
     */
    public function addClient() {
//On insère les données du client à l'aide d'une requête préparée avec un INSERT INTO et le nom des champs de la table
//et on insère les valeurs des variables via les marqueurs nominatifs
        $query = 'INSERT INTO `c3005_user` (`firstname`, `lastname`, `mail`, `address`, `phoneNumber`, `password`, `id_c3005_city`)
                  VALUES (:firstname, :lastname,  :mail, :address, :phoneNumber, :password, :id_c3005_city);';
        $queryResult = $this->db->prepare($query);
//On attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_city', $this->id_c3005_city, PDO::PARAM_INT);
//On utilise la méthode execute() via un return
        return $queryResult->execute();
    }

    /**
     * Méthode qui vérifie si une adresse mail est libre (registerController)
     * 0 = l'adresse mail n'existe pas ou 1 = l'adresse mail existe 
     * @return type number
     */
    function checkFreeMail() {
//On effectue une requête qui compte le nombre de ligne qui est égale au mail    
        $query = 'SELECT COUNT(*) AS `nbMail` FROM `c3005_user` WHERE `mail` = :mail';
//On crée un objet $result qui exécute la méthode query() avec comme paramètre $query 
        $result = $this->db->prepare($query);
        $result->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($result->execute()) {
            $checkFreeMail = $result->fetch(PDO::FETCH_OBJ);
        }
//On return soit 0 soit 1       
        return $checkFreeMail->nbMail;
    }

    /**
     * méthode pour lire le profil du client et récupère les infos utiles de l'utilisateur après sa connexion (loginController)
     * @return type array
     */
    public function getProfilclient() {
        $result = FALSE;
//On met notre requête dans la variable $query qui selectionne des champs de la table c3005_user et c3005_city en effectuant 
//une jointure sur l'id et l'id_c3005_city en fonction du mail de la table c3005_user
        $query = 'SELECT `c3005_user`.`id` AS `idUser`, `firstname`, `lastname`, `mail`, `phoneNumber`, `address`, `city`, '
                . '`zipcode`, `loyaltyPoint`, `id_c3005_role` '
                . 'FROM `c3005_user` LEFT JOIN `c3005_city` '
                . 'ON `c3005_city`.`id` = `c3005_user`.`id_c3005_city` '
                . 'WHERE `c3005_user`.`mail`=:mail';
//On crée un objet $queryResult qui exécute la méthode query() avec comme paramètre $query        
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
//On crée un objet $result qui affichera toutes les données de la requête grâce à la fonction fetch
//via le paramètre (PDO::FETCH_OBJ) si la méthode est exécuté
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Methode pour mettre à jour les informations d'un client en fonction de l'id de la table c3005_user (accountController)
     * @return update
     */
    public function updateClient() {
//On met à jour des données du client à l'aide d'une requête préparée avec un UPDATE et le nom des champs de la table
//et on insère les variables via les marqueurs nominatifs.
        $query = 'UPDATE `c3005_user` SET `firstname` = :firstname, `lastname` = :lastname, `mail` = :mail, '
                . '`address` = :address, `phoneNumber` = :phoneNumber, `password` = :password, `id_c3005_city` = :id_c3005_city '
                . 'WHERE `c3005_user`.`id` = :id';
//On attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_city', $this->id_c3005_city, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//On utilise la méthode execute() via un return
        return $queryResult->execute();
    }

    /**
     * Méthode qui supprime un profil client selon l'id de la table c3005_user (accountController)
     * @return type
     */
    public function deleteClientById() {
//On efface le profil client à l'aide d'une requête préparée avec un DELETE et l'id de la ligne à effacer         
        $query = 'DELETE FROM `c3005_user` WHERE `c3005_user`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $result = $queryResult->execute();
        return $result;
    }

    /*     ***************************CRUD CLIENT fin********************* */

    /**
     * Méthode qui retourne le hashage du mot de passe du compte sélectionné en fonction du mail (loginController)
     * @return type array
     */
    function getHashFromUser() {
        $result = FALSE;
//On met notre requète dans la variable $query qui selectionne le champ password de la table c3005_user
        $query = 'SELECT `password` FROM `c3005_user` WHERE `mail` = :mail';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode qui affiche le nom, le prénom et les points fidélié dans la liste déroulante des rendez-vous ou points fidélité (adminController)
     * @return type array
     */
    public function getClientList() {
        $result = array();
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_user
        $query = 'SELECT `id`, `lastname`, `firstname`,`loyaltyPoint` FROM `c3005_user` ORDER BY `lastname`';
        //On crée un objet $queryResult qui exécute la méthode query() avec comme paramètre $query 
        $queryResult = $this->db->query($query);
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode qui affiche le profil du client en cliquant sur profil (adminController)
     * @return type array
     */
    public function getProfilClientAdmin() {
//On met notre requête dans la variable $query qui selectionne des champs de la table c3005_user et c3005_city en effectuant 
//une jointure sur l'id et l'id_c3005_city en fonction de l'id de la table c3005_user
        $result = FALSE;
        $query = 'SELECT `c3005_user`.`id`, `firstname`, `lastname`, `mail`, `phoneNumber`, `address`, `city`,'
                . ' `zipcode`, `loyaltyPoint`, `id_c3005_role` '
                . 'FROM `c3005_user` '
                . 'LEFT JOIN `c3005_city` ON `c3005_city`.`id` = `c3005_user`.`id_c3005_city` '
                . 'WHERE `c3005_user`.`id`=:id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//On crée un objet $result qui affichera toutes les données de la requête grâce à la fonction fetch
//via le paramètre (PDO::FETCH_OBJ) si la méthode est exécuté
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode pour modifier les points fidélité (adminController)
     * @return update
     */
    public function updateLoyaltyPoint() {
//On met à jour les points fidélité du client à l'aide d'une requête préparée avec un UPDATE et le champs 
//loyaltyPoint de la table c3005_user et on insère les variables via le marqueur nominatif   
        $query = 'UPDATE `c3005_user` SET `loyaltyPoint` = :loyaltyPoint WHERE `c3005_user`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':loyaltyPoint', $this->loyaltyPoint, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

}
