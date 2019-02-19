  
<?php 

class appointment{
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
    }
    ?>