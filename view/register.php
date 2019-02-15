<?php
var_dump($_POST);
?>
<?php
include '../model/client.php';
include '../controller/registerController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5 mb-3"><!--marge left 3 marge top 5-->
        <p>Formulaire d'inscription</p>
        <form method="POST" action="register.php">
            <!--             changer les id type label...-->
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="lastname">Nom</label>
                    <!--la value permet de garder la valeur du champ quand on fait une erreur dans un autre champ-->
                    <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Nom" value="<?= isset($lastname) ? $lastname : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['lastname']) ? $formError['lastname'] : '' ?> </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="firstname">Prénom</label>
                    <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Prénom" value="<?= isset($firstname) ? $firstname : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['firstname']) ? $formError['firstname'] : '' ?> </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="mail">Email</label>
                    <input name="mail" type="email" class="form-control" id="mail" placeholder="Adresse mail" value="<?= isset($mail) ? $mail : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['mail']) ? $formError['mail'] : '' ?> </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmMail">Confirme adresse mail</label>
                    <input name="confirmMail"type="email" class="form-control" id="confirmMail" placeholder="Confirme adresse mail" value="<?= isset($confirmMail) ? $confirmMail : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['confirmMail']) ? $formError['confirmMail'] : '' ?> </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">Mot de passe</label>
                    <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe" value="<?= isset($password) ? $password : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['password']) ? $formError['password'] : '' ?> </p>
                </div>
                <div class="form-group col-md-6">
                    <label for="confirmPassword">Confirme mot de passe</label>
                    <input name="confirmPassword"type="password" class="form-control" id="confirmPassword" placeholder="Confirme mot de passe" value="<?= isset($confirmPassword) ? $confirmPassword : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['confirmPassword']) ? $formError['confirmPassword'] : '' ?> </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-12">
                    <label for="address">Adresse</label>
                    <input name="address" type="text" class="form-control" id="address" placeholder="Adresse" value="<?= isset($address) ? $address : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['address']) ? $formError['address'] : '' ?> </p>
                </div>
            </div>
            <div class="form-row">
                <div class="form-group col-md-4">
                    <label for="zipcode">Code postale</label>
                    <select name="zipcode" id="inputState" class="form-control">
                        <option selected disabled="">Choisir...</option>
                        <?php foreach ($cityList as $city) { ?>
                            <option value="<?= $city->id ?>"><?= $city->zipcode ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger"> <?= isset($formError['zipcode']) ? $formError['zipcode'] : '' ?> </p>
                </div>
                <div class="form-group col-md-4">
                    <label for="city">Ville</label>
                    <select name="city" id="city" class="form-control">
                        <option selected disabled="">Choisir...</option>
                        <?php foreach ($cityList as $city) { ?>
                            <option value="<?= $city->id ?>"><?= $city->city ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger"> <?= isset($formError['city']) ? $formError['city'] : '' ?> </p>
                </div>
                <div class="form-group col-md-4">
                    <label for="phoneNumber">Téléphone</label>
                    <input name="phoneNumber" type="tel" class="form-control" id="phoneNumber" placeholder="Téléphone" value="<?= isset($phoneNumber) ? $phoneNumber : '' ?>" />
                    <p class="text-danger"> <?= isset($formError['phoneNumber']) ? $formError['phoneNumber'] : '' ?> </p>
                </div>
            </div>
            <input class="btn btn-info" type="submit" value="S'enregitrer" name='submit' />
        </form>
    </div>
</div>
<?php
include '../template/footer.php';
?>

