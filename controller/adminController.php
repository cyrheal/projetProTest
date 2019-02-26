<?php
//Déclaration regex nom et prénom
$regexName = '/^[a-zA-Z\- ]+$/';
//Déclaration regex date et heure
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
//Variables pour la validation de la suppression d'un client
$isDelete = FALSE;
$isNotDelete = FALSE;
//Tableau des messages d'erreur
$formError = array();
//Variables pour la validation d'un un rendez-vous
$isSuccess = FALSE;
$isError = FALSE;
//Si $_POST['submit'] existe et que $_POST['idLastname'] existe alors je declare ma varible $id_c3005_user sinon je le stock dans mon tableau formError
if (isset($_POST['submit'])) {
//Menu déroulant pour le nom et prénom
    if (isset($_POST['idLastname'])) {
        $id_c3005_user = htmlspecialchars($_POST['idLastname']);
    } else {
        $formError['client'] = 'Veuillez selectioner un client';
    }
//Menu déroulant prestation
    if (isset($_POST['idPerformance'])) {
        $id_c3005_performance = htmlspecialchars($_POST['idPerformance']);
    } else {
        $formError['performance'] = 'Veuillez selectioner une prestation';
    }
//Date du rendez-vous
    if (isset($_POST['date'])) {
        if (!empty($_POST['date'])) {
            if (preg_match($regexDate, $_POST['date'])) {
                $date = htmlspecialchars($_POST['date']);
            } else {
                $formError['date'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
//Heure du rensez-vous
    if (isset($_POST['hour'])) {
        if (!empty($_POST['hour'])) {
            if (preg_match($regexHour, $_POST['hour'])) {
                $hour = htmlspecialchars($_POST['hour']);
            } else {
                $formError['hour'] = 'Votre heure de rendez-vous est invalide.';
            }
        } else {
            $formError['hour'] = 'Erreur,merci de remplir le champ heure de rendez-vous.';
        }
    }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instencie l'objet $appointment qui devient une instance de la classe appointment
    //        $appointment est un objet
    if (count($formError) == 0) {
        $appointment = new appointment();
        $appointment->dateHour = $date . ' ' . $hour;
        $appointment->id_c3005_user = $id_c3005_user;
        $appointment->id_c3005_performance = $id_c3005_performance;
        $checkAppointment = $appointment->checkFreeAppointment();
        if ($checkAppointment === '1') {
            $formError['checkAppointment'] = 'Ce rendez-vous n\'est pas disponible';
        } else if ($checkAppointment === '0') {
            $isSuccess = $appointment->getAddAppointments();
        } else {
            $isError = TRUE;
        }
    }
}
//Si $_POST['submitLoyalty'] existe et que $_POST['idLastname'] existe alors je declare ma varible $id_c3005_user sinon je le stock dans mon tableau formError
if (isset($_POST['submitLoyalty'])) {
//Menu déroulant pour le nom prénom
    if (isset($_POST['idLastname'])) {
        if (!empty($_POST['idLastname'])) {
            $id_c3005_user = htmlspecialchars($_POST['idLastname']);
        } else {
            $formError['clientLoyalty'] = 'Veuillez selectioner un client';
        }
    } else {
        $formError['clientLoyalty'] = 'client invalide';
    }
//Points fidélité
    if (isset($_POST['loyaltyPoint'])) {
        if (!empty($_POST['loyaltyPoint'])) {
            $loyaltyPoint = htmlspecialchars($_POST['loyaltyPoint']);
        } else {
            $formError['loyaltyPoint'] = 'Veuillez selectioner un chiffre';
        }
    } else {
        $formError['loyaltyPoint'] = 'chiffre invalide';
    }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instencie l'objet $client qui devient une instance de la classe client.
    if (count($formError) == 0) {
        $clientLoyaltyPoint = new client();
        $clientLoyaltyPoint->id = $id_c3005_user;
        $clientLoyaltyPoint->loyaltyPoint = $loyaltyPoint;
        $clientLoyaltyPoint->updateLoyaltyPoint();
    }
}
//Méthode pour lire infos des rendez-vous 
$appointmentList = new appointment();
$listAppointment = $appointmentList->getAppointmentsList();
//Méthode pour supprimer un rendez-vous
$appointmentDelete = new appointment();
if (!empty($_GET['idDelete'])) {
    $appointmentDelete->id = htmlspecialchars($_GET['idDelete']);
    if ($appointmentDelete->deleteAppointmentById()) {
        $isDelete = TRUE;
    } else {
        $isNotDelete = TRUE;
    }
}
//Méthode pour afficher le nom et prénom dans la liste déroulante d'un rendez-vous
$client = new client();
$clientList = $client->getClientList();
//méthode pour afficher le prix et la prestation dans la liste déroulante d'un rendez-vous
$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();

