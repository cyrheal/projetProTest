<?php

// $isAppointments = false;
$client = new client();
//méthode pour lire le rendezvous dans la page modifier un rendez vous
$appointment = new appointment();
if (!empty($_GET['id'])) {
    $appointment->id = htmlspecialchars($_GET['id']);
    $isAppointment = $appointment->getAppointment();
}
$client = new client();
//méthode pour le select client dans le rendez-vous
$clientList = $client->getClientList();

//méthode pour le select prestation dans le rendez-vous
$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();

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
    //on verifie si il n'y a pas d'erreur alors on instancie la classe patients.
    if (count($formError) === 0) {
        $appointments = new appointment();
        $appointments->id = $_GET['id'];
        $appointments->dateHour = $date . ' ' . $hour;
        $appointments->id_c3005_user = $id_c3005_user;
        $appointments->id_c3005_performance = $id_c3005_performance;
        $checkAppointment = $appointments->checkFreeAppointment();
             if ($checkAppointment === '1') {
            $formError['checkAppointment'] = 'Ce rendez-vous n\'est pas disponible';
        } else if ($checkAppointment === '0') {
          $isSuccess = $appointments->AppointmentUpdate();
//       header('Location:admin.php');
//            var_dump($appointment);
        } else {
            $formError['checkAppointment'] = 'Le devellopeur est en pause';
        }
        
        
        
       
//                if ($checkAppointment === '1') {
//            $formError['checkAppointment'] = 'Ce rendez-vous n\'est pas disponible';
//        } else if ($checkAppointment === '0') {
////             HEADER('location:liste-rendezvous.php');
//        } else {
//            $formError['checkAppointment'] = 'Le devellopeur est en pause';
//        }
    }
    }

