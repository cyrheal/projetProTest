<?php
include '../template/header.php';
include '../model/client.php';
include '../model/city.php';
include '../controller/accountController.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <?php if (isset($_SESSION['isConnect'])) {
            ?>
            <p>Informations personnelles :</p>
            <div class="table-responsive">
                <table class="table">
                    <thead>
                        <tr>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Mail</th>
                            <th>Adresse</th>
                            <th>Code postale et ville </th>
                            <th>Téléphone</th>
                            <th>Points fidélités</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!-- un tableau d objet-->
                        <tr>
                            <td><?= $_SESSION['lastname'] ?></td>
                            <td><?= $_SESSION['firstname'] ?></td>
                            <td><?= $_SESSION['mail'] ?></td>
                            <td><?= $_SESSION['address'] ?></td>
                            <td><?= $_SESSION['city'] ?></td>
                            <td><?= $_SESSION['phoneNumber'] ?></td>
                            <td><?= $_SESSION['loyaltyPoint'] ?></td>
                        </tr>
                    </tbody>

                </table>  
            </div>
            <div class="col-md-9 mainContent"><!--contenu principal, couleur colonne droite-->
                <div class="ml-3 mt-5 mb-3"><!--marge left 3 marge top 5-->
                    <p>Modifier mon profil :</p>
                    <form method="POST" action="account.php">
                        <!--             changer les id type label...-->
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="lastname">Nom</label>
                                <!--la value permet de garder la valeur du champ quand on fait une erreur dans un autre champ-->
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
                                <input name="confirmMail"type="email" class="form-control" id="confirmMail" placeholder="Confirme adresse mail" value="<?= $_SESSION['mail'] ?>" />
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
                                <input name="address" type="text" class="form-control" id="address" placeholder="Adresse" value="<?= $_SESSION['address'] ?>" />
                                <p class="text-danger"> <?= isset($formError['address']) ? $formError['address'] : '' ?> </p>
                            </div>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-4">
                                <label for="zipcode">Code postale</label>
                                <select name="zipcode" id="inputState" class="form-control">
                                    <?php foreach ($zipcodeList as $zipCode) { ?>
                                        <option <?php if ($_SESSION['zipcode'] == $zipCode->zipcode) { ?> selected <?php } ?> > <?= $zipCode->zipcode ?></option>
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
                        <input class="btn btn-info" type="submit" value="Changer mes coordonnées" name='submit' />
                        <p class="text-danger"> <?= isset($formError['modify']) ? $formError['modify'] : '' ?> </p>
                        <button class="btn btn-danger" name="deleteSubmit" type="submit">Supprimer</button>
                    </form>
                    <a class="btn blue-gradient btn-lg btn-block" href="account.php?idDelete=<?= $_SESSION['id'] ?>">Effacer</a>
                </div>
            </div>
            <?php
        } else {
            echo 'veuillez-vous reconnecter';
        }
        ?>
    </div>
</div>

<?php
include '../template/footer.php';
?>