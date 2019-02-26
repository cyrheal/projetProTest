<?php
include '../configuration.php';
include '../controller/appointmentChangeController.php';
include '../template/header.php';
include 'sidebar.php';
?>

<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5 mb-3"><!--marge left 3 marge top 5-->
        <?php if ($isAppointment) {
            ?>
            <div class="table-responsive mt-5">
                <p>Détail du rendez-vous :</p>
                <table class="table">
                    <thead>
                        <tr>
                            <th>id</th>
                            <th>idA</th>
                            <th>Nom</th>
                            <th>Prénom</th>
                            <th>Date</th>
                            <th>Heure</th>
                            <th>Description</th>
                            <th>Prix</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>   
                            <td><?= $isAppointment->idUser ?></td>
                            <td><?= $isAppointment->idAppointment ?></td>
                            <td><?= $isAppointment->lastname ?></td>
                            <td><?= $isAppointment->firstname ?></td>
                            <td><?= $isAppointment->date ?></td>
                            <td><?= $isAppointment->hour ?></td>
                            <td><?= $isAppointment->descriptive ?></td>
                            <td><?= $isAppointment->price ?></td>
                        </tr>

                    </tbody>
                </table>  
                <?php
            } else {
                ?>
                <p>Le rendez-vous n'a pas été trouvé</p>
            <?php } ?>
            <p><a href="admin.php" class="btn btn-success">retour</a></p>
        </div>
        <p class="text-danger"><?= isset($formError['checkAppointment']) ? $formError['checkAppointment'] : '' ?></p>
        <form method="POST" class="form" action="appointmentChange.php?id=<?= $appointment->id ?>">
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
                <legend>Modifier le rendez-vous un rendez-Vous</legend>
                <label for="idLastname"> Nom et prénom du client : </label>
                <select name="idLastname" id="idLastname">
                    <option disabled value="">Choix du client</option>
                    <?php foreach ($clientList as $clientDetail) { ?>
                        <option value = "<?= $clientDetail->id ?>" <?php if ($clientDetail->id == $isAppointment->idUser){?> selected <?php }?> ><?= $clientDetail->lastname . ' ' . $clientDetail->firstname ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['client']) ? $formError['client'] : '' ?></p>

                <label for="idPerformance">Prestation : </label>
                <select name="idPerformance" id="idPerformance">
                    <option disabled value="">Choix de la prestation</option>
                    <?php foreach ($listPerformance as $performanceDetail) { ?>
                        <option value = "<?= $performanceDetail->id ?>" <?php if ($performanceDetail->descriptive == $isAppointment->descriptive){?> selected<?php } ?> ><?= $performanceDetail->descriptive . ' ' . $performanceDetail->price ?></option>
                    <?php } ?>
                </select>
                <p class="text-danger"><?= isset($formError['performance']) ? $formError['performance'] : '' ?></p>
                <label for="date"> Date du rendez-vous : </label><input type="date" id="date" name="date" value="<?= $isAppointment->date ?>"/>
                <p class="text-danger"><?= isset($formError['date']) ? $formError['date'] : '' ?></p> 
                <p><label for="hour">Heure du rendez-vous (plage horaire 08:00 à 20:00) : </label><input id="hour" type="time" name="hour" min="08:00" max="20:00" value="<?= $isAppointment->hour ?>"/></p>
                <div>
                    <div class="nav-item">
                        <input type="submit" class="btn btn-info" value="Valider" name="submit"/>
                    </div>
                </div>
            </fieldset>
        </form>
    </div>
</div>
<?php
include '../template/footer.php';
?>