<?php

include '../controller/headerController.php';
?>
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="../assets/MDB-Free_4.7.0/css/bootstrap.min.css" rel="stylesheet" type="text/css"/>
        <link href="../assets/MDB-Free_4.7.0/css/mdb.min.css" rel="stylesheet" type="text/css"/>
        <title>Jessica Nails Beauty</title>
    </head>
    <body>
        <header>
            <h1>Jessica Nails Beauty</h1>                   
        </header> 
        <nav class="navbar navbar-expand-lg navbar-dark bgNavbar"><!--navbar-light = onglet noir,bgNavbar = couleur rose navbar-->
            <a class="navbar-brand" href="index.php">Jessica Nails Beauty</a>
            <!--burger menu en mode mobile-->
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavAltMarkup" aria-controls="navbarNavAltMarkup" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span><!--cible et control la navbar, a false pour que le menu burger soit par defaut rentré-->
            </button>
            <div class="collapse navbar-collapse" id="navbarNavAltMarkup">
                <div class="navbar-nav"><!--  navbar-nav = aligne à l'horizontal les onglets-->
                    <a class="nav-item nav-link" href="index.php">Accueil</a><!--home.php est inclus dans l'index-->
                    <a class="nav-item nav-link" href="prestation.php">Prestations et tarifs</a><!--nav-item nav link pour changer la couleur de bleu à l actuel-->
                    <a class="nav-item nav-link" href="appointment.php">Prendre RDV</a>
                    <a class="nav-item nav-link" href="organizer.php">Agenda</a>
                    <ul class="navbar-nav mr-auto">
                        <?php if (isset($_SESSION['isConnect']) && ((($_SESSION['id_c3005_role']) == 1 ) || ($_SESSION['id_c3005_role'] == 2))) { ?>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" role="button" data-toggle="dropdown"><?= $_SESSION['firstname']; ?></a>
                                <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="#">action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="?action=deconnexion">Déconnexion</a>
                                </div>
                            </li>
                        </ul>
                        <a class="nav-item nav-link" href="account.php">Mon compte</a><!--à changer si dossier renomer-->
                    <?php } else { ?>
                        <a class="nav-item nav-link" href="register.php">S'inscrire</a>
                        <a class="nav-item nav-link" href="login.php">Connexion</a>
                    <?php } ?>
                    <?php if (isset($_SESSION['isConnect']) && (($_SESSION['id_c3005_role']) == 1 )) { ?>
                        <a class="nav-item nav-link" href="admin.php">Administrateur</a>
                    <?php }
                    ?>
                </div>
            </div>
        </nav>  
        <div class="container-fluid">
            <div class="col-md-12 col-lg-12 col-xl-12 "><!--home est include dans index entre le header et le footer-->
                <div class="row">