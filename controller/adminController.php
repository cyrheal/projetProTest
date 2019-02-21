<?php


//    méthode lire info rendez-vous et supprimer
    $appointmentList = new appointment();
    $listAppointment = $appointmentList->getAppointmentsList();
    
//on appel la méthode grâce a $appointments qui se trouve dans ma classe et qui me retourne un tableau stocké dans $appointmentsList
//    $isDelete = FALSE;
//    if (!empty($_GET['idDelete'])) {
//        $appointments->id = htmlspecialchars($_GET['idDelete']);
//        if ($appointments->deleteAppointmentById()) {
//            $isDelete = TRUE;
//        }
//    }
    
$client = new client();
//on appel la méthode grâce a $patients qui se trouve dans ma classe et qui me retourne un tableau stocké dans $patientsList
$clientList = $client->getClientList();
$appointment = new appointment();
//méthode poue le select dans le rendez-vous
$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();
//Déclaration regex nom et prénom
$regexName = '/^[a-zA-Z\- ]+$/';
//Déclaration regex date
$regexDate = '/[0-9]{4}-[0-9]{2}-[0-9]{2}/';
$regexHour = '/(0[0-9]|1[0-9]|2[0-3]):[0-5][0-9]$/';
$formError = array();
$isSuccess = FALSE;
$isError = FALSE;
if (isset($_POST['submit'])) {
//menu déroulant pour le nom prénom
    if (isset($_POST['idLastname'])) {
        $id_c3005_user = htmlspecialchars($_POST['idLastname']);
    } else {
        $formError['client'] = 'Veuillez selectioner un patient';
    }
//menu déroulant prestation
    if (isset($_POST['idPerformance'])) {
        $id_c3005_performance = htmlspecialchars($_POST['idPerformance']);
    } else {
        $formError['performance'] = 'Veuillez selectioner une prestation';
    }
//Date du rdv
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
//Heure du rdv
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
//fin vérification du formulaire
    if (count($formError) == 0) {
        $appointment->dateHour = $date . ' ' . $hour;
        $appointment->id_c3005_user = $id_c3005_user;
        $appointment->id_c3005_performance = $id_c3005_performance;
        $checkAppointment = $appointment->checkFreeAppointment();
        if ($checkAppointment === '1') {
            $formError['checkAppointment'] = 'Ce rendez-vous n\'est pas disponible';
        } else if ($checkAppointment === '0') {
            $isSuccess = $appointment->getAddAppointments();
        } else {
            $formError['checkAppointment'] = 'Le devellopeur est en pause';
        }
    }
    

    
}