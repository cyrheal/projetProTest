<?php

$client = new client();
$listCity = new city();
//lire le rendez-vous
$appointment = new appointment();

    $listAppointment = $appointment->getAppointment();
    var_dump($listAppointment);

//méthode pour le menu déroulant ville
$cityList = $listCity->getCityList();
//méthode pour le menu déroulant code postale
$zipcodeList = $listCity->getZipcodeList();
//regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//regex nom et prénom
$regexName = '/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{2,70}$/';
//regex adresse
$regexAddress = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{5,150}$/';
//tableau des messages d'erreur
$formError = array();
//variable pour le message de confirmation de la modification du profil
$isSuccess = FALSE;
$isError = FALSE;
//Si $_POST['submit'] existe et que $_POST['lastname'] existe et différent de vide alors je vérifie le $_POST['lastname'] avec ma regex.
//Si $_POST['lastname'] respecte les conditions de ma regex,je declare ma varible $lastname sinon je le stock dans mon tableau formError.
if (isset($_POST['submit'])) {
//Nom du client  
    if (isset($_POST['lastname'])) {
        if (!empty($_POST['lastname'])) {
            if (preg_match($regexName, $_POST['lastname'])) {
                $lastname = htmlspecialchars($_POST['lastname']);
            } else {
                $formError['lastname'] = 'Votre nom est  invalide.';
            }
        } else {
            $formError['lastname'] = 'Erreur,merci de remplir le champ nom.';
        }
    }
//Prénom du client
    if (isset($_POST['firstname'])) {
        if (!empty($_POST['firstname'])) {
            if (preg_match($regexName, $_POST['firstname'])) {
                $firstname = htmlspecialchars($_POST['firstname']);
            } else {
                $formError['firstname'] = 'Votre prénom est  invalide.';
            }
        } else {
            $formError['firstname'] = 'Erreur,merci de remplir le champ nom.';
        }
    }
//Numéro de téléphone
    if (isset($_POST['phoneNumber'])) {
        if (!empty($_POST['phoneNumber'])) {
            if (preg_match($regexPhone, $_POST['phoneNumber'])) {
                $phoneNumber = htmlspecialchars($_POST['phoneNumber']);
            } else {
                $formError['phoneNumber'] = 'Votre numéro de téléphone est  invalide.';
            }
        } else {
            $formError['phoneNumber'] = 'Erreur,merci de remplir le champ numéro de téléphone.';
        }
    }
//adresse mail
    //On vérifie que l'adresse mail est renseigné, qu'il correspond à la confirmation et qu'il a la bonne forme.
    if (!empty($_POST['mail']) && !empty($_POST['confirmMail'])) {
        if ($_POST['mail'] == $_POST['confirmMail']) {
            if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Le courriel n\'est pas valide';
            }
        } else {
            $formError['mail'] = 'Les courriels ne sont pas identiques';
        }
    } else {
        $formError['mail'] = 'Veuillez renseigner un courriel';
        $formError['confirmMail'] = 'Veuillez confirmer le courriel';
    }
//Adresse postale
    if (isset($_POST['address'])) {
        if (!empty($_POST['address'])) {
            if (preg_match($regexAddress, $_POST['address'])) {
                $address = htmlspecialchars($_POST['address']);
            } else {
                $formError['address'] = 'Votre adresse est  invalide.';
            }
        } else {
            $formError['address'] = 'Erreur,merci de remplir le champ adresse.';
        }
    }
//On vérifie que le mot de passe est renseigné et qu'il est identique à la confirmation. On le hash avant de le mettre en base de données. 
    if (!empty($_POST['password']) && !empty($_POST['confirmPassword'])) {
        if ($_POST['password'] == $_POST['confirmPassword']) {
            $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        } else {
            $formError['password'] = 'Les mots de passe ne sont pas identiques';
        }
    } else {
        $formError['password'] = 'Veuillez renseigner un mot de passe';
        $formError['confirmPassword'] = 'Veuillez confirmer le mot de passe';
    }
//verification ville et code postale 
    if (!empty($_POST['city']) && (!empty($_POST['zipcode']))) {
        $id_c3005_city = htmlspecialchars($_POST['city']);
    } else {
        $formError['city'] = 'Veuillez renseigner la ville';
        $formError['zipcode'] = 'veuillez renseigner le code postale';
    }
//fin vérification du formulaire
    if (count($formError) == 0) {
        $clientUpdate = new client();
        $clientUpdate->id = $_SESSION['id'];
        $clientUpdate->firstname = $firstname;
        $clientUpdate->lastname = $lastname;
        $clientUpdate->mail = $mail;
        $clientUpdate->address = $address;
        $clientUpdate->phoneNumber = $phoneNumber;
        $clientUpdate->password = $password;
        $clientUpdate->id_c3005_city = $id_c3005_city;
        if ($clientUpdate->updateClient()) {
            $_SESSION['firstname'] = $firstname;
            $_SESSION['lastname'] = $lastname;
            $_SESSION['mail'] = $mail;
            $_SESSION['address'] = $address;
            $_SESSION['phoneNumber'] = $phoneNumber;
            $_SESSION['password'] = $password;
            $_SESSION['id_c3005_city'] = $id_c3005_city;
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}
//Supprimer un client
if (isset($_POST['deleteSubmit'])) {
    $client = new client();
    $client->id = htmlspecialchars($_SESSION['id']);
    if ($client->deleteClientById()) {
        header('Location:account.php');
        session_destroy();
    }
}



