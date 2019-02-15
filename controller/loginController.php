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

    if (count($formError) == 0){
        $client->mail = $mail;
        $hash = $client->getHashFromUser();
        if(is_object($hash)){
            $isConnect = password_verify($password, $hash->password);
            //l'utilisateur est connecté
            if($isConnect){
                $userInfo = $client->getUserInfo();
                $_SESSION['mail'] = $client->mail;
                $_SESSION['username'] = $userInfo->username;
                $_SESSION['idGroup'] = $userInfo->idGroup;
                $_SESSION['isConnect'] = true;
                header('Location:index.php');
                exit();
            }
        }
    }
}