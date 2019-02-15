<?php
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->

    <!--     remettre des col avec un offset md-1 col-md-8  pour retirer ml-3 mt5 et changer le ccs de performancetable -->

    <div class="offset-md-1 col-md-8 mt-5"><!--marge left 3 marge top 5 <div class="ml-3 mt-5">-->
        <h2>Prestations et tarifs</h2>
        <p>Voici mes tarifs avec la déco comprise (strass, paillettes et nail art simple) :</p>
        <table class="table performanceTable">
            <tr>
                <th class="performanceTh">Prestations</th>
                <th class="performanceTh">Tarifs</th>
            </tr>
            <tr>
                <td class="performanceTd">Pose de vernis semi permanent</td>
                <td class="performanceTd">15€</td>
            </tr>
            <tr>
                <td class="performanceTd">Pose gel sur ongles naturels</td>
                <td class="performanceTd">20€</td>
            </tr>
            <tr>
                <td class="performanceTd">Pose résine sur ongles naturels</td>
                <td class="performanceTd">25€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Pose capsule gel</td>
                <td class="performanceTd">35€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Pose chablon gel</td>
                <td class="performanceTd">40€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Pose capsule résine</td>
                <td class="performanceTd">40€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Pose chablon résine</td>
                <td class="performanceTd">45€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Remplissage gel</td>
                <td class="performanceTd">20€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Remplissage résine</td>
                <td class="performanceTd">25€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Dépose gel</td>
                <td class="performanceTd">10€</td>
            </tr>  
            <tr>
                <td class="performanceTd">Dépose résine</td>
                <td class="performanceTd">15€</td>
            </tr>
        </table>
    </div>
</div>
<?php
include '../template/footer.php';
?>