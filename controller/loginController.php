<?php
$formError = array();
$mail = '';
$password = '';
if (isset($_POST['login'])) {
    if (!empty($_POST['mail'])) {
        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
            $mail = htmlspecialchars($_POST['mail']);
        } else {
            $formError['mail'] = 'Le courriel n\'est pas valide';
        }
    } else {
        $formError['mail'] = 'Veuillez renseigner un courriel';
    }
    if (!empty($_POST['password'])) {
        $password = $_POST['password'];
    } else {
        $formError['password'] = 'Veuillez renseigner un mot de passe';
    }
    if (count($formError) == 0) {
        $client = new client();
        $client->mail = $mail;
//Méthode qui retourne le hashage du mot de passe du compte sélectionné        
        $hash = $client->getHashFromUser();
        if (is_object($hash)) {
//On vérifie que le mot de passe correspond au mot de passe haché
            $isConnect = password_verify($password, $hash->password);
            if ($isConnect) {
//Méthode qui récupère les informations utiles de l'utilisateur après sa connection   
//J'ai renomé $clientInfo->id en idUser, car il entré en conflit avec l'id de la ville               
                $clientInfo = $client->getProfilclient();
                $_SESSION['id'] = $clientInfo->idUser;
                $_SESSION['firstname'] = $clientInfo->firstname;
                $_SESSION['lastname'] = $clientInfo->lastname;
                $_SESSION['mail'] = $clientInfo->mail;
                $_SESSION['id_c3005_role'] = $clientInfo->id_c3005_role;
                $_SESSION['id_c3005_city'] = $clientInfo->id_c3005_city;
                $_SESSION['city'] = $clientInfo->city;
                $_SESSION['zipcode'] = $clientInfo->zipcode;
                $_SESSION['address'] = $clientInfo->address;
                $_SESSION['phoneNumber'] = $clientInfo->phoneNumber;
                $_SESSION['loyaltyPoint'] = $clientInfo->loyaltyPoint;
                $_SESSION['isConnect'] = true;
                header('Location:index.php');
                exit();
            }
        }
    }
}