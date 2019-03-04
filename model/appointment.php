<?php

class appointment extends database {

//Création d'attributs qui correspondent à chacun des champs de la table c3005_appointment
//et on les initialise par rapport à leurs types.
    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $id_c3005_user = 0;
    public $id_c3005_performance = 0;

//On appelle le __construct() du parent via parent::
    function construct() {
        parent::construct();
    }

    /**
     * Méthode pour créer un rendez-vous (adminController)
     * @return execute
     */
    public function getAddAppointments() {
//On insère les données du rendez-vous à l'aide de la requête préparée avec un INSERT INTO et le nom des champs de la table
//et on insère les valeurs des variables via les marqueurs nominatifs        
        $query = 'INSERT INTO `c3005_appointment` (`dateHour`,`id_c3005_user`,id_c3005_performance ) '
                . 'VALUES (:dateHour, :id_c3005_user, :id_c3005_performance)';
        $queryResult = $this->db->prepare($query);
//On attribue les valeurs via bindValue et on recupère les attributs de la classe via $this       
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        $queryResult->bindValue(':id_c3005_performance', $this->id_c3005_performance, PDO::PARAM_INT);
//On utilise la méthode execute() via un return        
        return $queryResult->execute();
    }

    /**
     * Méthode qui vérifie si un rendez-vous existe par rapport au client (adminController)
     * @return type boolean  
     */
    public function checkFreeAppointment() {
//On effectue une requête qui compte le nombre de ligne qui est égale à dateHour et id_c3005_user
//On place un marqueur nominatif pour récupérer les valeurs de dateHour et de id_c3005_user        
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `c3005_appointment` '
                . 'WHERE `dateHour`=:dateHour AND `id_c3005_user`=:id_c3005_user';
//On crée un objet $freeAppointment qui exécute la méthode query() avec comme paramètre $query 
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
//On effectue une condition pour donner une valeure booleenne à $resultObject      
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

    /**
     * Méthode pour lire les rendez-vous de la table c3005_appointment (adminController)
     * @return type array
     */
    public function getAppointmentsList() {
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_appointment, c3005_performance
//et c3005_user en effectuant une jointure sur l'id et l'id_c3005_user et sur l'id et id_c3005_performance 
        $result = array();
        $query = 'SELECT DATE_FORMAT(`c3005_appointment`.`dateHour`, "%d/%m/%Y") AS `date`,
                        DATE_FORMAT(`c3005_appointment`.`dateHour`, "%H:%i") AS `hour`,
                        `c3005_appointment`.`id` AS idAppointment,
                        `c3005_user`.`id` AS `idUser`,
                        `c3005_user`.`lastname`,
                        `c3005_user`.`firstname`,
                        `c3005_performance`.`descriptive`,
                        `c3005_performance`.`price`
                    FROM `c3005_appointment`
                    LEFT JOIN `c3005_user`ON `c3005_user`.`id` = `c3005_appointment`.`id_c3005_user`
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` 
                    ORDER BY `dateHour`';
        $queryResult = $this->db->query($query);
//On crée un objet $result qui est un tableau qui affichera toutes les données de la requête grâce à la fonction fetchAll
//via le paramètre (PDO::FETCH_OBJ) si $queryResult est un objet
        if (is_object($queryResult)) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode pour mettre à jour les informations d'un rendez selon l'id de la table c3005_appointment (appointmentChangeController)
     * @return un update
     */
    public function AppointmentUpdate() {
//Mise à jour des données du rendez-vous à l'aide d'une requête préparée avec un UPDATE et le nom des champs de la table 
//c3005_appointment et on insère les valeurs des variables via les marqueurs nominatifs
        $query = 'UPDATE `c3005_appointment` SET `dateHour` = :dateHour, `id_c3005_user` = :id_c3005_user,'
                . ' `id_c3005_performance` = :id_c3005_performance WHERE `c3005_appointment`.`id` = :id';
        $queryResult = $this->db->prepare($query);
//On attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        $queryResult->bindValue(':id_c3005_performance', $this->id_c3005_performance, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//On utilise la méthode execute() via un return       
        return $queryResult->execute();
    }

    /**
     * Méthode qui supprime un rendez-vous selon l'id dans la table c3005_appointment (adminController)
     * @return un delete
     */
    public function deleteAppointmentById() {
//On efface le rendez-vous à l'aide d'une requête préparée avec un DELETE et l'id de la ligne à effacer     
        $query = 'DELETE FROM `c3005_appointment` WHERE `c3005_appointment`.`id` = :id';
        $queryResult = $this->db->prepare($query);
//On attribue les valeurs via bindValue et on recupère l'es attributs'attribut de la classe via $this        
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    /**
     * Méthode pour lire le rendez-vous d'un client dans la page appointmentChange (appointmentChangeController)
     * @return type array
     */
    public function getAppointment() {
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_appointment, c3005_performance
//et c3005_user en effectuant une jointure sur l'id et l'id_c3005_user ainsi que sur l'id et id_c3005_performance 
//en fonction de l'id de la table c3005_appointment  
        $result = FALSE;
        $query = 'SELECT DATE_FORMAT(`c3005_appointment`.`dateHour`, "%d/%m/%Y") AS `date`,
                        DATE_FORMAT(`c3005_appointment`.`dateHour`, "%H:%i") AS `hour`,
                        `c3005_appointment`.`id` AS idAppointment,
                        `c3005_user`.`id` AS `idUser`,
                        `c3005_user`.`lastname`,
                        `c3005_user`.`firstname`,
                        `c3005_performance`.`descriptive`,
                        `c3005_performance`.`price`
                    FROM `c3005_appointment`
                    LEFT JOIN `c3005_user`ON `c3005_user`.`id` = `c3005_appointment`.`id_c3005_user`
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` 
                    WHERE `c3005_appointment`.`id` = :id';
//On crée un objet $queryResult qui utilise la fonction prepare avec comme paramètre $query
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//On crée un objet $result qui affichera toutes les données de la requête grâce à la fonction fetch
//via le paramètre (PDO::FETCH_OBJ) si on exécute la méthode        
        if ($queryResult->execute()) {
            $result = $queryResult->fetch(PDO::FETCH_OBJ);
        }
        return $result;
    }

    /**
     * Méthode pour lire les rendez-vous d'un client selon son id dans la table c3005_appointment (accountController)
     * @return type array
     */
    public function appointmentListByPatient() {
//On met notre requète dans la variable $query qui selectionne des champs de la table c3005_appointment, c3005_performance
//et c3005_user en effectuant une jointure sur l'id et l'id_c3005_user ainsi que sur l'id et id_c3005_performance 
        $result = array();
        $query = 'SELECT DATE_FORMAT(`c3005_appointment`.`dateHour`, "%d/%m/%Y") AS `date`,
                        DATE_FORMAT(`c3005_appointment`.`dateHour`, "%H:%i") AS `hour`,
                        `c3005_appointment`.`id` AS idAppointment,
                        `c3005_user`.`id` AS `idUser`,
                        `c3005_user`.`lastname`,
                        `c3005_user`.`firstname`,
                        `c3005_performance`.`descriptive`,
                        `c3005_performance`.`price`
                    FROM `c3005_appointment`
                    LEFT JOIN `c3005_user`ON `c3005_user`.`id` = `c3005_appointment`.`id_c3005_user`
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` 
                    WHERE `c3005_appointment`.`id_c3005_user` = :id_c3005_user';
//On crée un objet $queryResult qui prépare la requête avec comme paramètre $query
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
//On crée un objet $result qui est un tableau qui affichera toutes les données de la requête grâce à la fonction fetchAll
//via le paramètre (PDO::FETCH_OBJ) si on exécute la méthode        
        if ($queryResult->execute()) {
            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
        }
        return $result;
    }

}

?>