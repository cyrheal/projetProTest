<?php
include '../configuration.php';
include '../controller/prestationController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="mt-5 mb-5 ml-3">
        <h2>Prestations et tarifs</h2>
        <p>Voici mes tarifs avec la déco comprise (strass, paillettes et nail art simple) :</p>
    </div>
    <div class=" offset-md-1 col-md-8 mt-5 mb-5">
        <div class="performanceTable">
            <table class="table ">
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
</div>
<?php
include '../template/footer.php';
?>