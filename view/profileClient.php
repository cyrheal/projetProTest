<?php
include '../configuration.php';
include '../controller/profileClientController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="ml-3 mt-5">
        <!--tableau qui affiche le profil d'un client dans la partie admin-->
        <div class="table-responsive mb-5">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom</th>
                        <th>Prénom</th>
                        <th>Adresse</th>
                        <th>Code postale</th>
                        <th>Ville</th>
                        <th>Téléphone</th>
                        <th>Mail</th>
                        <th>Point fidélité</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td><?= $isClient->lastname ?></td>
                        <td><?= $isClient->firstname ?></td>
                        <td><?= $isClient->address ?></td>
                        <td><?= $isClient->zipcode ?></td>
                        <td><?= $isClient->city ?></td>
                        <td><?= $isClient->phoneNumber ?></td>
                        <td><?= $isClient->mail ?></td>
                        <td><?= $isClient->loyaltyPoint ?></td>
                    </tr>
                </tbody>
            </table> 
        </div>
        <p><a href="admin.php"><button  class="btn btn-blue-grey">retour</button></a></p>
    </div>
</div>
<?php
include '../template/footer.php';
?>