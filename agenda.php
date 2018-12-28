<?php
//Tableau associatif des 12 mois de l'année associant la clé du mois et sa valeur.
$months = array(1 => 'JANVIER', 2 => 'FEVRIER', 3 => 'MARS', 4 => 'AVRIL', 5 => 'MAI', 6 => 'JUIN', 7 => 'JUILLET', 8 => 'AOUT', 9 => 'SEPTEMBRE', 10 => 'OCTOBRE', 11 => 'NOVEMBRE', 12 => 'DECEMBRE');
if (isset($_POST['month']) && isset($_POST['year'])) {
    $month = $_POST['month'];
    $year = $_POST['year'];
} else {
    $month = date('n');
    $year = date('Y');
}
//On récupère le nombre de jours dans le mois avec la fonction date qui prend en paramètre un format timestamp.
$numberDaysInMonth = date('t', mktime(0, 0, 0, $month, 1, $year));
//On récupère le premier jour de la semaine du mois (du lundi au dimanche).
$firstWeekDayOfmonth = date('N', mktime(0, 0, 0, $month, 1, $year));
//Le numéro du jours en cours
$currentDay = 1;
?>
<?php
include 'template/header.php';
?>
<div class="col-md-12">
    <div class="row">
        <div class="col-md-3 colonneGauche"><!--couleur colonne gauche-->
            <ul class="mt-5">
                <li>TEST</li>
                <li>TEST</li>
                <li>TEST</li>
                <li>TEST</li>
                <li>TEST</li>
                <li>TEST</li>
            </ul>
        </div>
        <div class="col-md-9 colonneDroite"><!--couleur colonne droite-->
            <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
                <h3>Agenda</h3>
                <form class="form-group" name="form" method="POST" action="agenda.php" enctype="multipart/form-data"><!--mettre agenda.php a action-->
                    <label  for="month">Choisir un mois : </label>
                    <select name="month">
                        <?php
                        //boucle qui parcours le tableau month afin de créer les options
                        foreach ($months as $monthNumb => $monthName) {
                            ?>
                            <option value="<?= $monthNumb; ?>"<?= $month == $monthNumb ? 'selected' : '' ?>><?= $monthName; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <label  for="year">Choisir une année : </label>
                    <select name="year" id="year">
                        <?php for ($yearsList = 1970; $yearsList <= 2100; $yearsList++) { ?>
                            <option value="<?= $yearsList; ?>"<?= $year == $yearsList ? 'selected' : '' ?>><?= $yearsList; ?></option>
                            <?php
                        }
                        ?>
                    </select>
                    <input class="btn btn-success m-3 float-center" type="submit" name="valider" role="button" value="valider"/>
                </form>

                <div class="row mx-auto">
                    <div class="col-md-12">
                        <table>
                            <thead >
                            <th>Lun</th>
                            <th>Mar</th>
                            <th>Mer</th>
                            <th>Jeu</th>
                            <th>Ven</th>
                            <th>Sam</th>
                            <th>Dim</th>
                            </thead>
                            <tbody>
                                <tr>
                                    <?php
                                    /* daysTiles définit le nombre de case de mon calendrier.
                                     * la boucle parcours le nombre de jour et créée le nombre de case correspondante.
                                     * le -1 permet d'obtenir le nombre exact de case.  
                                     */
                                    for ($daysTiles = 1; $daysTiles <= $numberDaysInMonth + $firstWeekDayOfmonth - 1; $daysTiles++) {
                                        //le if nous place le premier jour du mois de la semaine.
                                        if ($firstWeekDayOfmonth <= $daysTiles) {
                                            ?> <td><?= $currentDay; ?></td><?php
                                            $currentDay++;
                                            //le else permet de créer des cases vides jusqu'au premier jour de la semaine
                                        } else {
                                            ?><td></td><?php
                                        }
                                        //multiple de 7 qui permet de passer à la ligne
                                        if ($daysTiles % 7 == 0) {
                                            ?></tr><tr><?php
                                        }
                                    }
                                    ?>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div><!--fin raw-->
</div><!--fin class col md 12-->
<?php
include 'template/footer.php';
?>