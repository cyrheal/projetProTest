<?php
//Méthode pour afficher le profil client quand on clique sur voir profil dans la partie administrateur
$client = new client();
if (!empty($_GET['id'])) {
//    id de l'objet client est egal au get id' et on le stoke dans la variable $isClient pour crée un tableau dans la page profileClient
    $client->id = htmlspecialchars($_GET['id']);
    $isClient = $client->getProfilClientAdmin();
  
}
?>