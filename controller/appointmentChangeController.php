<?php
//Déclaration regex date et heure
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
//Tableau des messages d'erreur
$formError = array();
//Variable pour le message de la modification du rendez-vous
$isSuccess = FALSE;
$isError = FALSE;
//Si $_POST['submit'] existe et que $_POST['idLastname'] existe alors je declare ma varible $id_c3005_user 
//sinon je le stock dans mon tableau formError
if (isset($_POST['submit'])) {
//Menu déroulant pour le nom prénom
    if (isset($_POST['idLastname'])) {
        $id_c3005_user = htmlspecialchars($_POST['idLastname']);
    } else {
        $formError['client'] = 'Veuillez selectioner un patient';
    }
//Menu déroulant des prestations
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
//Heure du rendez-vous
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
//Méthode pour la modification d'un rendez-vous   
//Si il n'y a pas d'erreur alors on instancie l'objet $appointments et on éxécute la méthode AppointmentUpdate
    if (count($formError) === 0) {
        $appointments = new appointment();
        $appointments->id = $_GET['id'];
        $appointments->dateHour = $date . ' ' . $hour;
        $appointments->id_c3005_user = $id_c3005_user;
        $appointments->id_c3005_performance = $id_c3005_performance;
        if ($appointments->AppointmentUpdate()) {
            $isSuccess = TRUE;
        } else {
            $isError = TRUE;
        }
    }
}
//Méthode pour lire le rendez-vous dans la page modifier un rendez-vous
$appointment = new appointment();
if (!empty($_GET['id'])) {
    $appointment->id = htmlspecialchars($_GET['id']);
    $isAppointment = $appointment->getAppointment();
}
//Méthode pour le select client dans le rendez-vous
$client = new client();
$clientList = $client->getClientList();
//Méthode pour le select prestation dans le rendez-vous
$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();



