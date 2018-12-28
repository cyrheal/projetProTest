<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="UTF-8">
        <title>ProjetPro</title>
        <link href="assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="assets/bootstrap/css/bootstrap.css" rel="stylesheet">
    </head>
    <body>
        <header>
            <img class="img-fluid" src="assets/img/header/headPink2.jpg" /><!-- img fluid = taille de l'image-->
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
                    <a class="nav-item nav-link" href="prestation.php">Prestation et tarifs</a><!--nav-item nav link pour changer la couleur de bleu à l actuel-->
                    <a class="nav-item nav-link" href="conseil.php">Conseil</a><!--à changer si dossier renomer-->
                    <a class="nav-item nav-link" href="contact.php">Contact</a>
                    <a class="nav-item nav-link" href="agenda.php">Agenda</a>
                </div>
            </div>
        </nav>
        <div class="container-fluid">