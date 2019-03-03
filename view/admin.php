<?php
include '../configuration.php';
include '../controller/adminController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="ml-3 mt-5 mb-3">
        <p class="text-danger"><?= isset($formError['checkAppointment']) ? $formError['checkAppointment'] : '' ?></p>
        <?php if ($isUpdate) { ?>
            <p class="text-success">Les points fidélité ont été mis à jour</p>
            <?php
        }
        if ($isNotUpdate) {
            ?>
            <p class="text-danger">Désolé, Les points fidélité n'ont pas été mis à jour</p>
            <?php
        }
        ?>
        <!--Formulaire pour ajouter un rendez-vous-->
        <form method="POST" action="admin.php" class="form">
            <?php if ($isSuccess) { ?>
                <p class="text-success">Votre rendez-vous a bien été prises en compte</p>
                <?php
            }
            if ($isError) {
                ?>
                <p class="text-danger">Désolé, votre rendez-vous n'a pu être enregistré !</p>
                <?php
            }
            ?>
            <fieldset>
                <legend>Ajouter un rendez-Vous</legend>
                <label for="idLastname"> Nom et prénom du client : </label>
                <select name="idLastname" id="idLastname">
                    <option value="">Choix du client</option>
                    <?php foreach ($clientList as $clientDetail) { ?>
                        <option value = "<?= $clientDetail->id ?>"><?= $clientDetail->lastname . ' ' . $clientDetail->firstname ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['client']) ? $formError['client'] : '' ?></p>

                <label for="idPerformance">Prestation : </label>
                <select name="idPerformance" id="idPerformance">
                    <option value="">Choix de la prestation</option>
                    <?php foreach ($listPerformance as $performanceDetail) { ?>
                        <option value = "<?= $performanceDetail->id ?>"><?= $performanceDetail->descriptive . ' ' . $performanceDetail->price ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['performance']) ? $formError['performance'] : '' ?></p>
                <label for="date"> Date du rendez-vous : </label><input type="date" id="date" name="date" value="<?= isset($date) ? $date : '' ?>"/>
                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                <p><label for="hour">Heure du rendez-vous (plage horaire 08:00 à 20:00) : </label><input id="hour" type="time" name="hour" min="08:00" max="20:00" value="<?= isset($hour) ? $hour : '' ?>"/></p>
                <p class="text-danger"><?= isset($formError['hour']) ? $formError['hour'] : '' ?></p> 
                <div>
                    <div class="nav-item">
                        <button type="submit" class="btn btn-unique" name="submit"> Valider</button>
                    </div>
                </div>
            </fieldset>
        </form>
        <!--tableau de la liste des rendez-vous-->
        <div class="table-responsive mt-5">
            <div class="size">Liste des rendez-vous :</div>
            <?php if ($isDelete) { ?>
                <p class="text-success">Votre rendez-vous a bien été supprimé</p>
                <?php
            }
            if ($isNotDelete) {
                ?>
                <p class="text-danger">Désolé, votre rendez-vous n'a pu être supprimé !</p>
                <?php
            }
            ?>
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Description</th>
                        <th>Prix</th>
                        <th>Profil</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($listAppointment AS $appointments) { ?>
                        <tr>   
                            <td><?= $appointments->lastname ?></td>
                            <td><?= $appointments->firstname ?></td>
                            <td><?= $appointments->date ?></td>
                            <td><?= $appointments->hour ?></td>
                            <td><?= $appointments->descriptive ?></td>
                            <td><?= $appointments->price ?></td>
                            <td><a class="btn btn-deep-purple" href="profileClient.php?id=<?= $appointments->idUser ?>">Voir Profil</a></td>
                            <td><a class="btn btn-dark-green" href="appointmentChange.php?id=<?= $appointments->idAppointment ?>">Modifier</a></td> 
                            <td><a class="btn btn-danger" href="admin.php?idDelete=<?= $appointments->idAppointment ?>">Supprimer</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  
        </div>
        <!--formulaire pour les points fidélité-->
        <form method="POST" action="admin.php" class="form">
            <fieldset>
                <legend>Ajouter des points fidélité</legend>
                <label for="idLastname"> Nom et prénom du client : </label>
                <select name="idLastname" id="idLastname">
                    <option value="">Choix du client</option>
                    <?php foreach ($clientList as $clientDetail) { ?>
                        <option value = "<?= $clientDetail->id ?>"><?= $clientDetail->lastname . ' ' . $clientDetail->firstname . ' | points fidélité ' . $clientDetail->loyaltyPoint ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['clientLoyalty']) ? $formError['clientLoyalty'] : '' ?></p>
                <label for="loyaltyPoint"> Points de fidélités : </label><input type="number" id="loyaltyPoint" name="loyaltyPoint" value="<?= isset($loyaltyPoint) ? $loyaltyPoint : ''; ?>"/>
                <p class="text-danger"><?= isset($formError['loyaltyPoint']) ? $formError['loyaltyPoint'] : '' ?></p> 
                <div>
                    <div class="nav-item">
                        <button type="submit" class="btn btn-unique" name="submitLoyalty"> Valider</button>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php
include '../template/footer.php';
?>