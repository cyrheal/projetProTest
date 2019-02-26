<?php

$performance = new performance();
$listPerformance = $performance->getPriceByPerformance();

if (isset($_POST['submit'])) {
    //adresse mail
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
//menu déroulant prestation
    if (isset($_POST['idPerformance'])) {
        $id_c3005_performance = htmlspecialchars($_POST['idPerformance']);
    } else {
        $formError['performance'] = 'Veuillez selectioner une prestation';
    }
//Date du rdv
    if (isset($_POST['date'])) {
        if (!empty($_POST['date1'])) {
            if (preg_match($regexDate, $_POST['date1'])) {
                $date1 = htmlspecialchars($_POST['date1']);
            } else {
                $formError['date1'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date1'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
    //Date du rdv
    if (isset($_POST['date2'])) {
        if (!empty($_POST['date2'])) {
            if (preg_match($regexDate, $_POST['date2'])) {
                $date2 = htmlspecialchars($_POST['date2']);
            } else {
                $formError['date2'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date2'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
    //Date du rdv
    if (isset($_POST['date3'])) {
        if (!empty($_POST['date3'])) {
            if (preg_match($regexDate, $_POST['date3'])) {
                $date3 = htmlspecialchars($_POST['date3']);
            } else {
                $formError['date3'] = 'Votre date de rendez-vous est invalide.';
            }
        } else {
            $formError['date3'] = 'Erreur,merci de remplir le champ date de rendez-vous.';
        }
    }
//    rajouter test area isset

//fin vérification du formulaire
//    if (count($formError) == 0) {
//        $appointment = new appointment();
//        $appointment->dateHour = $date . ' ' . $hour;
//        $appointment->id_c3005_user = $id_c3005_user;
//        $appointment->id_c3005_performance = $id_c3005_performance;
//        $checkAppointment = $appointment->checkFreeAppointment();
//    
//    }
}

    //fin vérification du formulaire