<?php
//Regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//Regex nom et prénom
$regexName = '/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{2,70}$/';
//Regex adresse
$regexAddress = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{5,150}$/';
//Tableau des messages d'erreur
$formError = array();
//Variables pour le message de confirmation de la modification du profil
$isSuccess = FALSE;
$isError = FALSE;
//Si $_POST['submit'] existe et que $_POST['lastname'] existe et différent de vide alors je vérifie le 
//$_POST['lastname'] avec ma regex. Si $_POST['lastname'] respecte les conditions de ma regex,je declare
// ma varible $lastname sinon je le stock dans mon tableau formError.
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
//Adresse mail
//On vérifie que l'adresse mail est renseigné, qu'il correspond à la confirmation et qu'il a la bonne forme.
    if (isset($_POST['mail']) && isset($_POST['confirmMail'])) {
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
//Mot de passe
//On vérifie que le mot de passe est renseigné et qu'il est identique à la confirmation 
//et on le hash avant de le mettre en base de données. 
    if (isset($_POST['password']) && isset($_POST['confirmPassword'])) {
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
    }
//verification ville et code postale 
    if (isset($_POST['city']) && (isset($_POST['zipcode']))) {
        if (!empty($_POST['city']) && (!empty($_POST['zipcode']))) {
            $id_c3005_city = htmlspecialchars($_POST['city']);
        } else {
            $formError['city'] = 'Veuillez renseigner la ville';
            $formError['zipcode'] = 'veuillez renseigner le code postale';
        }
    }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instancie l'objet $clientUpdate 
//grâce à la classe client
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
//Méthode pour que le client modifie ses informations
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
//Méthode pour que le client supprime son compte
//Si $_GET['deleteSubmit'] n'est pas vide on attribue à $client id la valeur du get avec un htmlspecialchars
//pour la protection et on applique la méthode deleteClientById pour supprimer le profil du client  
if (isset($_POST['deleteSubmit'])) {
    $client = new client();
    $client->id = htmlspecialchars($_SESSION['id']);
    if ($client->deleteClientById()) {
        header('Location:index.php');
        session_destroy();
    }
}
$listCity = new city();
//Méthode pour le menu déroulant ville
$cityList = $listCity->getCityList();
//Méthode pour le menu déroulant code postale
$zipcodeList = $listCity->getZipcodeList();
//Méthode pour que le client lis son ou ses rendez-vous 
$appointment = new appointment();
$appointment->id_c3005_user = $_SESSION['id'];
$appointmentsList = $appointment->appointmentListByPatient();




