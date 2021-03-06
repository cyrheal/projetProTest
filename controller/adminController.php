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
//Variables pour le message de la création d'un rendez-vous
$isSuccess = FALSE;
$isError = FALSE;
//Variables pour le message de la mofification d'un rendez-vous
$isUpdate = FALSE;
$isNotUpdate = FALSE;
//Si $_POST['submit'] existe et que $_POST['idLastname'] existe alors je declare ma varible $id_c3005_user 
//sinon je le stock dans mon tableau formError
if (isset($_POST['submit'])) {
//Menu déroulant pour le nom et prénom
    if (isset($_POST['idLastname'])) {
        if (!empty($_POST['idLastname'])) {
            $id_c3005_user = htmlspecialchars($_POST['idLastname']);
        } else {
            $formError['client'] = 'Veuillez selectioner un client';
        }
    }
//Menu déroulant prestation
    if (isset($_POST['idPerformance'])) {
        if (!empty($_POST['idPerformance'])) {
            $id_c3005_performance = htmlspecialchars($_POST['idPerformance']);
        } else {
            $formError['performance'] = 'Veuillez selectioner un client';
        }
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
            $formError['date'] = 'Veuillez remplir le champ date du rendez-vous.';
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
            $formError['hour'] = 'Veuillez remplir le champ heure du rendez-vous.';
        }
    }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instancie l'objet $appointment 
//qui devient une instance de la classe appointment.On concatène les valeurs de date et de hour, puis 
//on éxécute la méthode checkFreeAppointment() pour vérifier si le rendez-vous est libre.
//Si c'est libre, on éxécute la méthode getAddAppointments() pour créer un rendez-vous
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
//Si $_POST['submitLoyalty'] existe et que $_POST['idLastname'] existe alors je declare ma varible 
//$id_c3005_user sinon je le stock dans mon tableau formError
if (isset($_POST['submitLoyalty'])) {
//Menu déroulant pour le nom prénom
    if (isset($_POST['idLastname'])) {
        if (!empty($_POST['idLastname'])) {
            $id_c3005_user = htmlspecialchars($_POST['idLastname']);
        } else {
            $formError['clientLoyalty'] = 'Veuillez selectioner un client';
        }
    }
//Points fidélité
    if (isset($_POST['loyaltyPoint'])) {
        if (!empty($_POST['loyaltyPoint'])) {
            $loyaltyPoint = htmlspecialchars($_POST['loyaltyPoint']);
        } else {
            $formError['loyaltyPoint'] = 'Veuillez selectioner un chiffre';
        }
    }
//Si je valide le formulaire et que le tableau d'erreur est vide, on instancie l'objet $clientLoyaltyPoint 
//et on éxécute la méthode updateLoyaltyPoint() pour modifier les points fidélité du client 
    if (count($formError) == 0) {
        $clientLoyaltyPoint = new client();
        $clientLoyaltyPoint->id = $id_c3005_user;
        $clientLoyaltyPoint->loyaltyPoint = $loyaltyPoint;
        if ($clientLoyaltyPoint->updateLoyaltyPoint()) {
            $isUpdate = TRUE;
        } else {
            $isNotUpdate = TRUE;
        }
    }
}
//Méthode pour lire la liste des rendez-vous 
$appointmentList = new appointment();
$listAppointment = $appointmentList->getAppointmentsList();
//Méthode pour supprimer un rendez-vous d'un client
$appointmentDelete = new appointment();
if (!empty($_GET['idDelete'])) {
    $appointmentDelete->id = htmlspecialchars($_GET['idDelete']);
    if ($appointmentDelete->deleteAppointmentById()) {
        $listAppointment = $appointmentList->getAppointmentsList();
        $isDelete = TRUE;
    } else {
        $isNotDelete = TRUE;
    }
}
//Méthode pour afficher le nom et prénom dans la liste déroulante d'un rendez-vous
$client = new client();
$clientList = $client->getClientList();
//Méthode pour afficher le prix et la prestation dans la liste déroulante d'un rendez-vous
$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();

