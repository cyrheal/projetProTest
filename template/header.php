<!-- OK -->
<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <link href="../assets/css/style.css" rel="stylesheet" type="text/css">
        <link href="../assets/bootstrap/css/bootstrap.css" rel="stylesheet">
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
                    <a class="nav-item nav-link" href="prestation.php">Prestation et tarifs</a><!--nav-item nav link pour changer la couleur de bleu à l actuel-->
                    <a class="nav-item nav-link" href="contact.php">Contact</a>
                    <a class="nav-item nav-link" href="organizer.php">Agenda</a>
                    <a class="nav-item nav-link" href="register.php">S'inscrire</a><!--à changer si dossier renomer-->
                    <a class="nav-item nav-link" href="admin.php">Administrateur</a>
                </div>
            </div>
        </nav>       
        <div class="container-fluid">
            <div class="col-md-12"><!--home est include dans index entre le header et le footer-->
    <div class="row">