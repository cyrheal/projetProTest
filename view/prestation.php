<?php
include '../configuration.php';
include '../controller/prestationController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <!--     remettre des col avec un offset md-1 col-md-8  pour retirer ml-3 mt5 et changer le ccs de performancetable -->
    <!--    boucle foreach descriptive prix -->
    <div class="offset-md-1 col-md-8 mt-5 mb-5"><!--marge left 3 marge top 5 <div class="ml-3 mt-5">-->
        <h2>Prestations et tarifs</h2>
        <p>Voici mes tarifs avec la déco comprise (strass, paillettes et nail art simple) :</p>
        <table class="table performanceTable">
            <thead>
                <tr>
                    <th class="performanceTh" scope="col">Prestations</th>
                    <th class="performanceTh" scope="col">Prix</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($listPerformance as $performance) { ?>
                    <tr>
                        <td class="performanceTd"><?= $performance->descriptive ?></td>
                        <td class="performanceTd"><?= $performance->price ?></td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>
</div>
<?php
include '../template/footer.php';
?>