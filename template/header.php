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
                    <a class="nav-item nav-link" href="account.php">Mon compte</a><!--à changer si dossier renomer-->
                    <a class="nav-item nav-link" href="register.php">S'inscrire</a>
                    <a class="nav-item nav-link" data-toggle="modal" data-target="#connection">Connexion</a>
                    <a class="nav-item nav-link" href="admin.php">Administrateur</a>
                </div>
            </div>
        </nav>  
        <div class="modal" id="connection" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <div class="modal-content" id="modalStyle">
                    <div class="modal-header">
                        <h5 class="modal-title">Connexion</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form>
                            <div class="form-group">
                                <label for="exampleInputEmail1">Adresse mail</label>
                                <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Adresse mail">
                            </div>
                            <div class="form-group">
                                <label for="exampleInputPassword1">Mot de passe</label>
                                <input type="password" class="form-control" id="exampleInputPassword1" placeholder="Mot de passe">
                            </div>
                            <button type="submit" class="btn btn-primary">Connexion</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <!--                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>-->
                        <!--                        <button type="button" class="btn btn-primary">Connexion</button>-->
                        <a class="btn btn-info" href="register.php">S'inscrire</a>
                    </div>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="col-md-12 col-lg-12 col-xl-12 "><!--home est include dans index entre le header et le footer-->
                <div class="row">