<?php
$address = '';
$phoneNumber = '';
//Déclaration regex numéro de téléphone
$regexPhone = '/^[0-9]{10}$/';
//Déclaration regex nom et prénom
$regexName = "/^[a-zA-Z\- ]+$/";
//Déclaration regex date
$regexAddress = "/^[a-zA-Z\- ]+$/";
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
//si le submit est isset
if (isset($_POST['submit'])) {
    if (isset($_POST['lastname'])) {
        // Si $POST lastName extsite alors je declare ma varible $lastname
        // et je la verrifie avec ma regex.
        // si mon $_POST['lastname'] est différent de vide
//Nom du patient
        if (!empty($_POST['lastname'])) {
            // Si lastname ne respecte pas les conditions de ma regex alors je stock un message d'erreur
            // dont mon tableau formError
            if (preg_match($regexName, $_POST['lastname'])) {
                $lastname = htmlspecialchars($_POST['lastname']);
            } else {
                $formError['lastname'] = 'Votre nom est  invalide.';
            }
        } else {
            $formError['lastname'] = 'Erreur,merci de remplir le champ nom.';
        }
    }
//Prénom du patient
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
    // Si mail ne respecte pas le filter_var alors je stock un message d'erreur
    // dont mon tableau formError
    //Emploi de la fonction PHP Filter_var pour valider l'adresse Email.
    if (isset($_POST['mail'])) {
        if (!empty($_POST['mail'])) {
            if (FILTER_VAR($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
                $mail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['mail'] = 'Votre mail est  invalide.';
            }
        } else {
            $formError['mail'] = 'Erreur,merci de remplir le champ adresse mail.';
        }
    }
//    comfirmation mail
    if (isset($_POST['confirmMail'])) {
        if (!empty($_POST['confirmMail'])) {
            if (FILTER_VAR($_POST['confirmMail'], FILTER_VALIDATE_EMAIL)) {
                $confirmMail = htmlspecialchars($_POST['mail']);
            } else {
                $formError['confirmMail'] = 'Votre confirmation mail est invalide.';
            }
        } else {
            $formError['confirmMail'] = 'Erreur,merci de remplir le champ confirmation adresse mail.';
        }
    }
//    adresse
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
//fin vérification du formulaire

    if (count($formError) == 0) {
//Instenciation de l'objet patients. 
//$patients devient une instance de la classe patients.
//la methode magique construct est appelée automatiquement 
//grace au mot clé new.
        $client = new client();
        $client->lastname = $lastname;
        $client->firstname = $firstname;
        $client->mail = $mail;
        $client->address = $address;
        $client->phoneNumber = $phoneNumber;
        $client->password = $phoneNumber;
        $client->addClient();
        if ($client->addClient()) {

            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}
?>