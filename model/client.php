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
    private $db;

    public function __construct() {
        try {
            $this->db = new PDO('mysql:host=jessicanailsbeauty;dbname=jessicanailsbeauty;charset=utf8', 'cyril', 'la198677');
        } catch (Exception $ex) {
            $ex->getMessage();
        }
    }

    //ajouter un client (1)
    public function addClient() {
        $query = 'INSERT INTO `c3005_user`(`firstname`, `lastname`, `mail`, `address`, `phoneNumber`, `password`) VALUES (:firstname, :lastname, :mail, :address, :phoneNumber, :password)';
        $queryResult = $this->db->prepare($query);
        $queryResult->bindValue(':firstname', $this->firstname, PDO::PARAM_STR);
        $queryResult->bindValue(':lastname', $this->lastname, PDO::PARAM_STR);
        $queryResult->bindValue(':mail', $this->mail, PDO::PARAM_STR);
        $queryResult->bindValue(':address', $this->address, PDO::PARAM_STR);
        $queryResult->bindValue(':phoneNumber', $this->phoneNumber, PDO::PARAM_STR);
        $queryResult->bindValue(':password', $this->password, PDO::PARAM_STR);
        return $queryResult->execute();
    }

}

?>  