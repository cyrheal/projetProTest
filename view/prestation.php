<?php
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-12 col-lg-9 col-xl-9 mainContent"><!--couleur colonne droite-->

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
                <td class="performanceTd">Pose de vernis semi permanent mains ou pieds</td>
                <td class="performanceTd">15€</td>
            </tr>
            <tr>
                <td class="performanceTd">Pose gel sur ongles naturels mains ou pieds</td>
                <td class="performanceTd">20€</td>
            </tr>
            <tr>
                <td class="performanceTd">Pose résine sur ongles naturels mains ou pieds</td>
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
            <tr>
                <td class="performanceTd">nail art complexe</td>
                <td class="performanceTd">sup. entre 2€ et 5€</td>
            </tr>
        </table>
        <p>Le déplacement est gratuit dans un rayon de 5 km autour de Soissons. Au-delà de 5 km, il y a un supplément : </p>
        <table class="table performanceTable">
            <tr>
                <th class="performanceTh">Nombre de kilomètres</th>
                <th class="performanceTh">Supplément</th>
            </tr>
            <tr>
                <td class="performanceTd">plus de 5 km jusqu'à 10 km</td>
                <td class="performanceTd">1€</td>
            </tr>
            <tr>
                <td class="performanceTd">plus de 10 km jusqu'à 15 km</td>
                <td class="performanceTd">2€</td>
            </tr>
            <tr>
                <td class="performanceTd">plus de 15 km jusqu'à 20 km</td>
                <td class="performanceTd">3€</td>
            </tr>
            <tr>
                <td class="performanceTd">plus de 20 km jusqu'à 25 km</td>
                <td class="performanceTd">4€</td>
            </tr>
        </table>
    </div>
</div>
<?php
include '../template/footer.php';
?>