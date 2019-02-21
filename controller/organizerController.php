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