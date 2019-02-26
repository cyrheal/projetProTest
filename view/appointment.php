<?php
include '../configuration.php';
include '../controller/appointmentController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <h2>Prendre un rendez-vous</h2>
        <p>Vous pouvez me contacter via ma page Facebook ou Instagam pour prendre un rendez-vous : </p>
        <div class="row mt-3 mb-3">
            <div class="offset-1" >
                <a href="https://www.facebook.com/profile.php?id=100002743732510" target="_blank"><img class="facebook" src="../assets/img/logoFacebook.svg" alt="facebook"/></a>
                <a href="https://www.instagram.com/nailsbeautybyjess_soissons/" target="_blank"><img class="instagram" src="../assets/img/logoInstagram.svg" alt="instagram"/></a>
            </div>
        </div>
        <p>Connectez-vous pour prendre rendez-vous via notre formulaire; choisissez ensuite une prestation et 3 dates auxquelles vous serez disponible. Je reviendrais vers vous et vous proposerais des créneaux horaires, valables 24H.</p>
        <?php if (isset($_SESSION['isConnect']) && ((($_SESSION['id_c3005_role']) == 1 ) || ($_SESSION['id_c3005_role'] == 2))) { ?>
            <form method="POST" action="appointment.php" class="form">
                <fieldset>
                    <legend>Choix du rendez-vous et de la prestation</legend>
                    <div class="form-group col-md-6">
                        <label for="mail">Adresse mail</label>
                        <input name="mail" type="email" class="form-control" id="mail" placeholder="Adresse mail" value="<?= isset($mail) ? $mail : '' ?>" />
                        <p class="text-danger"> <?= isset($formError['mail']) ? $formError['mail'] : '' ?> </p>
                    </div>
                    <label for="idPerformance">Prestation : </label>
                    <select name="idPerformance" id="idPerformance">
                        <option value="">Choix de la prestation</option>
                        <?php foreach ($listPerformance as $performanceDetail) { ?>
                            <option value = "<?= $performanceDetail->id ?>"><?= $performanceDetail->descriptive . ' ' . $performanceDetail->price ?></option>
                        <?php } ?>
                    </select>
                    <p class="text-danger"><?= isset($formError['performance']) ? $formError['performance'] : '' ?></p>
                    <div class="row">
                        <div class="form-group col-md-4">

                            <label for="date"> Date du 1er rendez-vous : </label><input type="date" id="date" name="date1" value=""/>
                            <p class="text-danger"><?= isset($formError['date1']) ? $formError['date1'] : '' ?></p> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date"> Date du 2ème rendez-vous : </label><input type="date" id="date" name="date2" value=""/>
                            <p class="text-danger"><?= isset($formError['date']) ? $formError['date2'] : '' ?></p> 
                        </div>
                        <div class="form-group col-md-4">
                            <label for="date"> Date du 3ème rendez-vous : </label><input type="date" id="date" name="date3" value=""/>
                            <p class="text-danger"><?= isset($formError['date3']) ? $formError['date3'] : '' ?></p> 
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="textarea">Précision (optionnel)</label>
                        <textarea class="form-control" id="textarea1" rows="3"></textarea>
                    </div>
                    <div class="nav-item">
                        <button type="submit" class="btn btn-info" name="submit"> Valider</button>
                    </div>
                </fieldset>
            </form>
        <?php } ?>
    </div>
</div>
<?php
include '../template/footer.php';
?>