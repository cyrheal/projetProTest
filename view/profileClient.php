<?php
include '../template/header.php';
include '../model/client.php';
include '../model/city.php';
include '../controller/accountController.php';
include 'sidebar.php';
?>

<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
<table class="table">
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prénom</th>
            <th>Date de naissance</th>
            <th>Téléphone</th>
            <th>email</th>
        </tr>
    </thead>
    <tbody>
       
<!--        if ($isPatient) {-->
          
            <!-- un tableau d objet-->
            <tr>
                <td><?= $client->lastname ?></td>
                <td><?= $client->firstname ?></td>
                <td><?= $client->birthdate ?></td>
                <td><?= $client->phone ?></td>
                <td><?= $client->mail ?></td>
            </tr>
        </tbody>
    </table>  
       </div>
       </div>
     
<?php
include '../template/footer.php';
?>