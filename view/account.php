<?php
include '../configuration.php';
include '../controller/accountController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="ml-3 mt-5">
        <!--Tableau pour que le client lise ses rendez-vous-->
        <?php if (isset($_SESSION['isConnect'])) { ?>
            <div class="table-responsive mt-5">
                <p class="size">Liste de mes rendez-vous :</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Description</th>
                            <th>Prix</th>
                    </thead>
                    <tbody>
                        <?php foreach ($appointmentsList AS $appointments) { ?>
                            <tr>   
                                <td><?= $appointments->date ?></td>
                                <td><?= $appointments->hour ?></td>
                                <td><?= $appointments->descriptive ?></td>
                                <td><?= $appointments->price ?></td></tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <!--Tableau pour que le client lise son profil-->
            <p class="size">Mes informations personnelles :</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Mail</th>
                            <th>Adresse</th>
                            <th>Code postale</th>
                            <th>Ville</th>
                            <th>Téléphone</th>
                            <th>Points fidélité</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><?= $_SESSION['lastname'] ?></td>
                            <td><?= $_SESSION['firstname'] ?></td>
                            <td><?= $_SESSION['mail'] ?></td>
                            <td><?= $_SESSION['address'] ?></td>
                            <td><?= $_SESSION['zipcode'] ?></td>
                            <td><?= $_SESSION['city'] ?></td>
                            <td><?= $_SESSION['phoneNumber'] ?></td>
                            <td><?= $_SESSION['loyaltyPoint'] ?></td>
                        </tr>
                    </tbody>
                </table>  
            </div>
            <!--formulaire pour que le client modifie ses informations-->
            <div class="ml-3 mt-5 mb-3">
                <p class="size">Modifier mon profil :</p>
                <form method="POST" action="account.php">
                    <?php if ($isSuccess) { ?>
                        <p class="text-success">Votre modification a bien été prise en compte</p>
                        <?php
                    }
                    if ($isError) {
                        ?>
                        <p class="text-danger">Désolé, votre modification n'a pu être enregistré !</p>
                        <?php
                    }
                    ?>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="lastname">Nom</label>
                            <input name="lastname" type="text" class="form-control" id="lastname" placeholder="Nom" value="<?= $_SESSION['lastname'] ?>" />
                            <p class="text-danger"> <?= isset($formError['lastname']) ? $formError['lastname'] : '' ?> </p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="firstname">Prénom</label>
                            <input name="firstname" type="text" class="form-control" id="firstname" placeholder="Prénom" value="<?= $_SESSION['firstname'] ?>" />
                            <p class="text-danger"> <?= isset($formError['firstname']) ? $formError['firstname'] : '' ?> </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="mail">Email</label>
                            <input name="mail" type="email" class="form-control" id="mail" placeholder="Adresse mail" value="<?= $_SESSION['mail'] ?>" />
                            <p class="text-danger"> <?= isset($formError['mail']) ? $formError['mail'] : '' ?> </p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmMail">Confirme adresse mail</label>
                            <input name="confirmMail" type="email" class="form-control" id="confirmMail" placeholder="Confirme adresse mail" value="<?= $_SESSION['mail'] ?>" />
                            <p class="text-danger"> <?= isset($formError['confirmMail']) ? $formError['confirmMail'] : '' ?> </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-6">
                            <label for="password">Mot de passe actuel ou nouveau</label>
                            <input name="password" type="password" class="form-control" id="password" placeholder="Mot de passe actuel ou nouveau" value="" />
                            <p class="text-danger"> <?= isset($formError['password']) ? $formError['password'] : '' ?> </p>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="confirmPassword">Confirme mot de passe actuel ou nouveau</label>
                            <input name="confirmPassword" type="password" class="form-control" id="confirmPassword" placeholder="Confirme mot de passe actuel ou nouveau" value="" />
                            <p class="text-danger"> <?= isset($formError['confirmPassword']) ? $formError['confirmPassword'] : '' ?> </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-12">
                            <label for="address">Adresse</label>
                            <input name="address" type="text" class="form-control" id="address" placeholder="Adresse" value="<?= $_SESSION['address'] ?>" />
                            <p class="text-danger"> <?= isset($formError['address']) ? $formError['address'] : '' ?> </p>
                        </div>
                    </div>
                    <div class="form-row">
                        <div class="form-group col-md-4">
                            <label for="zipcode">Code postale</label>
                            <select name="zipcode" id="zipcode" class="form-control">
                                <?php foreach ($zipcodeList as $zipCode) { ?>
                                <option value="<?= $zipCode->zipcode ?>" <?php if ($_SESSION['zipcode'] == $zipCode->zipcode) { ?> selected <?php } ?> > <?= $zipCode->zipcode ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"> <?= isset($formError['zipcode']) ? $formError['zipcode'] : '' ?> </p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="city">Ville</label>
                            <select name="city" id="city" class="form-control">
                                <?php foreach ($cityList as $city) { ?>
                                    <option value="<?= $city->id ?>" <?php if ($_SESSION['city'] == $city->city) { ?> selected <?php } ?>><?= $city->city ?></option>
                                <?php } ?>
                            </select>
                            <p class="text-danger"> <?= isset($formError['city']) ? $formError['city'] : '' ?> </p>
                        </div>
                        <div class="form-group col-md-4">
                            <label for="phoneNumber">Téléphone</label>
                            <input name="phoneNumber" type="tel" class="form-control" id="phoneNumber" placeholder="Téléphone" value="<?= $_SESSION['phoneNumber'] ?>" />
                            <p class="text-danger"> <?= isset($formError['phoneNumber']) ? $formError['phoneNumber'] : '' ?> </p>
                        </div>
                    </div>
                    <input class="btn btn-dark-green" type="submit" name="submit" value="Changer mes coordonnées" />
                    <p class="text-danger"> <?= isset($formError['modify']) ? $formError['modify'] : '' ?> </p>
                    <input class="btn btn-danger" type="submit" name="deleteSubmit" value="Supprimer mon compte" />
                </form>
            </div>
            <?php
        } else {
            echo 'Vous avez été déconnecté';
        }
        ?>
    </div>
</div>
<?php
include '../template/footer.php';
?>