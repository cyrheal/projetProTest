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
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <h3>Agenda</h3>
        <form class="form-group" name="form" method="POST" action="view/organizer.php" enctype="multipart/form-data"><!--mettre agenda.php a action-->
            <label  for="month">Mois : </label>
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
            <label  for="year">Année : </label>
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
                <table class="calendarTable">
                    <thead >
                    <th class="calendarTh">Lun</th>
                    <th class="calendarTh">Mar</th>
                    <th class="calendarTh">Mer</th>
                    <th class="calendarTh">Jeu</th>
                    <th class="calendarTh">Ven</th>
                    <th class="calendarTh">Sam</th>
                    <th class="calendarTh">Dim</th>
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
                                    ?> <td class="calendarTd"><?= $currentDay; ?></td><?php
                                    $currentDay++;
                                    //le else permet de créer des cases vides jusqu'au premier jour de la semaine
                                } else {
                                    ?><td class="calendarTd"></td><?php
                                    }
                                    //multiple de 7 qui permet de passer à la ligne, si 7/7= 1 et reste 0
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
<?php
include '../template/footer.php';
?>