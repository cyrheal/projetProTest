  
<?php

class appointment {

    public $id = 0;
    public $dateHour = '0000-00-00 00:00:00';
    public $id_c3005_user = 0;
    public $id_c3005_performance = 0;
    public $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=jessicanailsbeauty;dbname=jessicanailsbeauty;charset=utf8', 'cyril', 'la198677');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
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

}

?>