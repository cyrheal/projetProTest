$(function () {
    $('#mailRegister').blur(function () {
        //Mon appel AJAX
        //$.post prend en paramètre la page PHP qui va effectuer le traitement, la variable que l'on communique au PHP, et la fonction de traitement avec la réponse de PHP.
        $.post('../controller/registerController.php', {mailTest: $(this).val()}, function (data) {
            //dans data se trouve ce que le PHP a envoyé via son echo
            if(data == 0){
                //Le .html permet d'écrire du contenu HTML dans un élément. Ici dans la div qui a la classe mailMessage
                $('.mailMessage').html('<p class="text-success">L\'adresse mail est disponible</p>');
            }else{
                $('.mailMessage').html('<p class="text-danger">L\'adresse mail est déjà utilisée</p>');
            }
        });
    });
})