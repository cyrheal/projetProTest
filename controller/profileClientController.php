<?php
//Si $_GET['id'] n'est pas vide on attribue à $client id la valeur du get avec un htmlspecialchars
//pour la protection et on éxécute la méthode getProfilClientAdmin() et je la stock dans la variable 
//$isClient pour afficher le profil client quand on clique sur voir profil dans la partie administrateur
$client = new client();
if (!empty($_GET['id'])) {
    $client->id = htmlspecialchars($_GET['id']);
    $isClient = $client->getProfilClientAdmin();
}
?>