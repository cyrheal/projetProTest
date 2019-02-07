<?php
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-12 col-lg-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <p>Formulaire d'inscription</p>
        <form>
            <!--            changer les id type label...-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <input type="text" class="form-control" id="lastname" placeholder="Nom">
                </div>
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input type="text" class="form-control" id="firstname" placeholder="Prénom">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="mail">Email</label>
                    <input type="email" class="form-control" id="mail" placeholder="Adresse mmail">
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmMail">Confirme adresse mail</label>
                    <input type="email" class="form-control" id="confirmMail" placeholder="Confirme adresse mail">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input type="password" class="form-control" id="password" placeholder="Mot de passe">
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmPassword">Confirme mot de passe</label>
                    <input type="password" class="form-control" id="confirmPassword" placeholder="Confirme mot de passe">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="address">Adresse</label>
                    <input type="text" class="form-control" id="address" placeholder="Adresse">
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="inputState">Ville</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputState">Code postale</label>
                    <select id="inputState" class="form-control">
                        <option selected>Choose...</option>
                        <option>...</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="inputAddress2">Téléphone</label>
                    <input type="text" class="form-control" id="inputAddress2" placeholder="Téléphone">
                </div>
            </div>
            <button type="submit" class="btn btn-primary">S'enregistrer</button>
        </form>
    </div>
</div>
<?php
include '../template/footer.php';
?>