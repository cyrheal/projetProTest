  
<?php

class appointment extends database {

    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $id_c3005_user = 0;
    public $id_c3005_performance = 0;

    function construct() {
        parent::construct();
    }

//crée un rendez-vous
    public function getAddAppointments() {
        // On insert les données du patient à l'aide de la requête INSERT INTO et le nom des champs de la table
        $query = 'INSERT INTO `c3005_appointment` (`dateHour`,`id_c3005_user`,id_c3005_performance ) VALUES (:dateHour, :id_c3005_user, :id_c3005_performance)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        $queryResult->bindValue(':id_c3005_performance', $this->id_c3005_performance, PDO::PARAM_INT);
        return $queryResult->execute();
    }

    //        verifie que le rendez vous est libre a commenter la fin pour l explication
    public function checkFreeAppointment() {
        $result = FALSE;
        $query = 'SELECT COUNT(`id`) AS `takenAppointment` FROM `c3005_appointment` WHERE `dateHour`=:dateHour AND `id_c3005_user`=:id_c3005_user';
        $freeAppointment = $this->db->prepare($query);
        $freeAppointment->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $freeAppointment->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        if ($freeAppointment->execute()) {
            $resultObject = $freeAppointment->fetch(PDO::FETCH_OBJ);
            $result = $resultObject->takenAppointment;
        }
        return $result;
    }

//    lire les rendez-vous
    public function getAppointmentsList() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments et patients en effectuant une jointure
        // sur l'id et l'idpatient.
        $resultList = FALSE;
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
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` ORDER BY `dateHour`';
// On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $result = $this->db->query($query);
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }

    //    lire le rendez-vous pour le changer
    public function getAppointment() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments et patients en effectuant une jointure
        // sur l'id et l'idpatient.
        $return = FALSE;
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
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` WHERE `c3005_appointment`.`id` = :id';
// On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        $queryResult->execute();
        $return = $queryResult->fetch(PDO::FETCH_OBJ);
        return $return;
    }

    //affiche le profil du patient (7)
//    public function getAppointmentById() {
//        $return = FALSE;
//        $isOk = FALSE;
//        $query = 'SELECT DATE_FORMAT(`appointments`.`dateHour`, "%d/%m/%Y") AS `date`,
//            DATE_FORMAT(`appointments`.`dateHour`, "%Y-%m-%d") AS `dateUS`,
//                  DATE_FORMAT(`appointments`.`dateHour`, "%H:%i") AS `hour`,                        
//                 `appointments`.`id`,
//                 `appointments`.`idPatients`,
//                  `patients`.`lastname`,
//                  `patients`.`firstname`,     
//                  `patients`.`phone`   
//                  FROM `appointments`
//                  LEFT JOIN `patients` 
//                  ON `appointments`.`idPatients`=`patients`.`id`
//                  WHERE `appointments`.`id` = :idAppointment';
//        $queryResult = $this->db->prepare($query);
//        $queryResult->bindValue(':idAppointment', $this->id, PDO::PARAM_INT);
////si la requete c'est bien executé alors on rempli $returnArray avec un objet         
//        if ($queryResult->execute()) {
//            $return = $queryResult->fetch(PDO::FETCH_OBJ);
//        }
////si $return est un objet alors on hydrate       
//        if (is_object($return)) {
//            $this->date = $return->date;
//            $this->hour = $return->hour;
//            $this->lastname = $return->lastname;
//            $this->firstname = $return->firstname;
//            $this->phone = $return->phone;
//            $this->dateUS = $return->dateUS;
//            $this->idPatients = $return->idPatients;
//            $this->id = $return->id;
//            $isOk = TRUE;
//        }
//        return $isOk;
//    }
//    modifie le rendez vous
    public function AppointmentUpdate() {
        $query = 'UPDATE `c3005_appointment` SET `dateHour` = :dateHour, `id_c3005_user` = :id_c3005_user, `id_c3005_performance` = :id_c3005_performance WHERE `c3005_appointment`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        // on attribue les valeurs via bindValue et on recupère les attributs de la classe via $this
        $queryResult->bindValue(':dateHour', $this->dateHour, PDO::PARAM_STR);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        $queryResult->bindValue(':id_c3005_performance', $this->id_c3005_performance, PDO::PARAM_INT);
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }
 public function deleteAppointmentById() {
        $query = 'DELETE FROM `c3005_appointment` WHERE `c3005_appointment`.`id` = :id';
        $queryResult = $this->db->prepare($query);
        // on attribue les valeurs avec bindValue et on recupère les attributs avec $this
        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
        return $queryResult->execute();
    }
       /**
     * méthode pour afficher sous ses informations la liste de ses rendez-vous (9)
     * @return type
     */
//        public function appointmentListByPatient() {
//        $result = array();
//        $query = 'SELECT `c3005_appointment`.`id`, DATE_FORMAT(`c3005_appointment`.`dateHour`, "%d/%m/%Y") AS date, 
//                  DATE_FORMAT(`c3005_appointment`.`dateHour`, "%H:%i") AS hour,
//                 `id_c3005_user` FROM `c3005_appointment` WHERE `c3005_appointment`.`id_c3005_user`=:id';
//        $queryResult = $this->db->prepare($query);
//        $queryResult->bindValue(':id', $this->id, PDO::PARAM_INT);
//        if ($queryResult->execute()) {
//            $result = $queryResult->fetchAll(PDO::FETCH_OBJ);
//        }
//        return $result;
//    }
    
        //    lire les rendez-vous du client
    public function appointmentListByPatient() {
        // On met notre requète dans la variable $query qui selectionne tous les champs de la table appointments et patients en effectuant une jointure
        // sur l'id et l'idpatient.
        $return = FALSE;
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
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` WHERE `c3005_appointment`.`id_c3005_user` = :id_c3005_user';
// On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':id_c3005_user', $this->id_c3005_user, PDO::PARAM_INT);
        $queryResult->execute();
        $return = $queryResult->fetchAll(PDO::FETCH_OBJ);
        return $return;
    }
}

?>