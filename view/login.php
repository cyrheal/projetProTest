<?php
include '../configuration.php';
include '../controller/loginController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="ml-3 mt-5">
        <div class="container col-md-9">
            <form method="POST" action="#">
                <div class="form-group">
                    <label for="mail">Courriel</label>
                    <input type="email" name="mail" class="form-control" id="mail"  placeholder="Renseignez votre courriel" />
                    <div class="mailMessage"></div>
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" name="password" class="form-control" id="password"  placeholder="Renseignez votre mot de passe" />
                </div>
                <button type="submit" name="login" class="btn btn-unique">Se connecter</button>
            </form>
        </div>
    </div>
</div>
<?php
include '../template/footer.php';
?>