<?php
//$isPatient = false;
$client = new client();


if (!empty($_GET['id'])) {
    $client->id = htmlspecialchars($_GET['id']);
    $isClient = $client->getProfilClientAdmin();
    var_dump($isClient);
}
//
//$appointments = new appointments();
//$appointments->id = $patients->id;
//$appointmentsList = $appointments->appointmentListByPatient();
////regexVariable
//$nameRegex = "/^[a-zA-Z\- ]+$/";
//$phoneRegex = "/^0[1-9]{1}[0-9]{8}$/";
////création d'un tableau d'erreur, ou l'on vient stocker les erreurs des != champs 
//$formError = array();
////verifier que le submit est bien isset
//if (isset($_POST['submit'])) {
////On verifie si tout les post sont bien isset (remplis) ou =! de empty.
////Si erreur il y a on les stock dans la variable $formError.
//    if (!empty($_POST['lastname'])) {
//        // On preg_match (regex, variable) afin de comparer la variable avec la regex
//        if (preg_match($nameRegex, $_POST['lastname'])) {
//            $lastname = htmlspecialchars($_POST['lastname']);
//        } else {
//            $formError['lastname'] = 'le champs n\'est pas valide';
//        }
//    } else {
//        $formError['lastname'] = 'le champs est vide';
//    }
//    if (!empty($_POST['firstname'])) {
//        if (preg_match($nameRegex, $_POST['firstname'])) {
//            $firstname = htmlspecialchars($_POST['firstname']);
//        } else {
//            $formError['firstname'] = 'le champs n\'est pas valide';
//        }
//    } else {
//        $formError['firstname'] = 'le champs est vide';
//    }
//    if (!empty($_POST['birthdate'])) {
//        $birthdate = htmlspecialchars($_POST['birthdate']);
//    } else {
//        $formError['birthdate'] = 'le champs n\'est pas valide';
//    }
//    if (!empty($_POST['mail'])) {
//        if (filter_var($_POST['mail'], FILTER_VALIDATE_EMAIL)) {
//            $mail = htmlspecialchars($_POST['mail']);
//        } else {
//            $formError['mail'] = 'le champs n\'est pas valide';
//        }
//    } else {
//        $formError['mail'] = 'le champs est vide';
//    }
//    if (!empty($_POST['phone'])) {
//        if (preg_match($phoneRegex, $_POST['phone'])) {
//            $phone = htmlspecialchars($_POST['phone']);
//        } else {
//            $formError['phone'] = 'le champs n\'est pas valide';
//        }
//    } else {
//        $formError['phone'] = 'le champs est vide';
//    }
//    //on verifie si il n'y a pas d'erreur alors on instancie la classe "patients".
//    if (count($formError) === 0) {
//        $patients->lastname = $lastname;
//        $patients->firstname = $firstname;
//        $patients->birthdate = $birthdate;
//        $patients->mail = $mail;
//        $patients->phone = $phone;
//        $patients->updatePatient();
//    }
//}
?>