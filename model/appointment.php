  
<?php

class appointment extends database {

    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $id_c3005_user = 0;
    public $id_c3005_performance = 0;
   

    function construct() {
        parent::construct();
    }

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
                        `c3005_appointment`.`id`,
                        `c3005_user`.`id` AS `idUser`,
                        `c3005_user`.`lastname`,
                        `c3005_user`.`firstname`,
                        `c3005_performance`.`descriptive`,
                        `c3005_performance`.`price`
                    FROM `c3005_appointment`
                    LEFT JOIN `c3005_user`ON `c3005_user`.`id` = `c3005_appointment`.`id_c3005_user`
                    LEFT JOIN `c3005_performance` ON `c3005_performance`.`id` = `c3005_appointment`.`id_c3005_performance` ORDER BY `c3005_user`.`lastname`';
// On crée un objet $getAppointmentsById qui prépare la requête avec comme paramètre $query
        $result = $this->db->query($query);
        // On crée un objet $resultList qui est un tableau.
        // La fonction fetchAll permet d'afficher toutes les données de la requète dans un tableau d'objet via le paramètre (PDO::FETCH_OBJ)
        $resultList = $result->fetchAll(PDO::FETCH_OBJ);
        return $resultList;
    }

}

?>