<?php

$client = new client();
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
        $client->mail = $mail;
        $hash = $client->getHashFromUser();
        if (is_object($hash)) {
            $isConnect = password_verify($password, $hash->password);
            //l'utilisateur est connecté
            if ($isConnect) {
                $clientInfo = $client->getProfilclient();
//     j'ai renomé dans la méthode getProfilclient() $_SESSION['id'] = $clientInfo->id en idUser, qui rentré en conflit avec l id de la ville
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