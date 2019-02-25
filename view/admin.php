<?php
include '../configuration.php';
include '../controller/adminController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <!--        début formulaire pour ajouter un rendez-vous-->
        <p class="text-danger"><?= isset($formError['checkAppointment']) ? $formError['checkAppointment'] : '' ?></p>
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
                <div>
                    <div class="nav-item">
                        <input type="submit" class="valid" value="Valider" name="submit"/></a>
                    </div>
                </div>
            </fieldset>
        </form>
        <!--        fin formulaire pour ajouer un rendez-vous-->

        <!--début formulaire pour lire un rendez-vous-->

        <div class="table-responsive mt-5">
            <p>Liste des rendez-vous :</p>
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
                        <th>id</th>
                        <th>idA</th>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Date</th>
                        <th>Heure</th>
                        <th>Descriptive</th>
                        <th>Price</th>
                        <th>Profil</th>
                        <th>Modifier</th>
                        <th>Supprimer</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- un tableau d objet-->
                    <?php foreach ($listAppointment AS $appointments) { ?>
                        <tr>   
                            <td><?= $appointments->idUser ?></td>
                            <td><?= $appointments->idAppointment ?></td>
                            <td><?= $appointments->lastname ?></td>
                            <td><?= $appointments->firstname ?></td>
                            <td><?= $appointments->date ?></td>
                            <td><?= $appointments->hour ?></td>
                            <td><?= $appointments->descriptive ?></td>
                            <td><?= $appointments->price ?></td>
                            <td><a class="btn btn-primary" href="profileClient.php?id=<?= $appointments->idUser ?>">Voir Profil</a></td>
                            <!--                            changer link -->
                            <td><a class="btn btn-success" href="appointmentChange.php?id=<?= $appointments->idAppointment ?>">Modifier</a></td> 
                            <td><a class="btn btn-danger" href="admin.php?idDelete=<?= $appointments->idAppointment ?>">Supprimer</a></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>  

        </div>
        <!-- fin formulaire pour lire un rendez-vous       -->




        <p>Points fidélité : </p>
        <div class="form-group col-md-4">
            <label for="inputState">Client</label>
            <select id="inputState" class="form-control">
                <option selected>Choisir...</option>
                <option>...</option>
            </select>
        </div>
        <input type="number" />
        <p>Rendez-vous</p>
    </div>
</div>
<?php
include '../template/footer.php';
?>