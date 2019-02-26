<?php

//Appel AJAX pour le mail
if (isset($_POST['mailTest'])) {
    include '../configuration.php';
    $clientMail = new client();
    $clientMail->mail = htmlspecialchars($_POST['mailTest']);
    echo $clientMail->checkFreeMail();
} else {
//Si mon adresse mail est disponible :   
//regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//regex nom et prénom
$regexName = '/^[a-zA-ZáàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{2,70}$/';
//regex date adresse
$regexAddress = '/^[a-zA-Z0-9áàâäãåçéèêëíìîïñóòôöõúùûüýÿæœÁÀÂÄÃÅÇÉÈÊËÍÌÎÏÑÓÒÔÖÕÚÙÛÜÝŸÆŒ._\s-]{5,150}$/';
//Tableau des messages d'erreur
$formError = array();
//variables pour le message de confirmation de l'inscription
$isSuccess = FALSE;
$isError = FALSE;
//Si $_POST['submit'] existe et que $_POST['lastname'] existe et différent de vide alors je vérifie le $_POST['lastname'] avec ma regex.
//Si $_POST['lastname'] respecte les conditions de ma regex,je declare ma varible $lastname sinon je le stock dans mon tableau formError.
//Nom du client    
    if (isset($_POST['submit'])) {
        if (isset($_POST['lastname'])) {
            if (!empty($_POST['lastname'])) {
                // Si lastname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
                // dont mon tableau formError
                if (preg_match($regexName, $_POST['lastname'])) {
                    $lastname = htmlspecialchars($_POST['lastname']);
                } else {
                    $formError['lastname'] = 'Votre nom est  invalide.';
                }
            } else {
                $formError['lastname'] = 'Veuillez remplir le champ nom.';
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
                $formError['firstname'] = 'Veuillez remplir le champ nom.';
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
                $formError['phoneNumber'] = 'Veuillez remplir le champ numéro de téléphone.';
            }
        }
//Adresse mail
        //On vérifie que l'adresse mail est renseigné, qu'il correspond à la confirmation et qu'il a la bonne forme.
        if (!empty($_POST['mail']) && !empty($_POST['confirmMail'])) {
            if ($_POST['mail'] == $_POST['confirmMail']) {
                if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                    $mail = htmlspecialchars($_POST['mail']);
                } else {
                    $formError['mail'] = 'Le mail n\'est pas valide';
                }
            } else {
                $formError['mail'] = 'Les mails ne sont pas identiques';
            }
        } else {
            $formError['mail'] = 'Veuillez renseigner un mail';
            $formError['confirmMail'] = 'Veuillez confirmer le mail';
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
                $formError['address'] = 'Veuillez remplir le champ adresse.';
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
//Verification de la ville et du code postale
        if (!empty($_POST['city']) && (!empty($_POST['zipcode']))) {
            $id_c3005_city = htmlspecialchars($_POST['city']);
        } else {
            $formError['city'] = 'Veuillez renseigner la ville';
            $formError['zipcode'] = 'veuillez renseigner le code postale';
        }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instencie l'objet $client qui devient une instance de la classe client.
        if (count($formError) == 0) {
            $client = new client();
            $client->lastname = $lastname;
            $client->firstname = $firstname;
            $client->mail = $mail;
            $client->address = $address;
            $client->phoneNumber = $phoneNumber;
            $client->password = $password;
            $client->id_c3005_city = $id_c3005_city;
            if ($client->addClient()) {
                $isSuccess = TRUE;
                $lastname = "";
                $firstname = "";
                $mail = "";
                $address = "";
                $phoneNumber = "";
                $password = "";
                $id_c3005_city = "";
            } else {
                $isError = TRUE;
            }
        }
    }
$listCity = new city();
//méthode pour la liste déroulante de la ville
$cityList = $listCity->getCityList();
//méthode pour la liste déroulante du code postale
$zipcodeList = $listCity->getZipcodeList();
}
?>