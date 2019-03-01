<?php
include '../configuration.php';
include '../controller/appointmentController.php';
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent">
    <div class="ml-3 mt-5">
        <h2>Prendre un rendez-vous</h2>
        <p>Vous pouvez me contacter via ma page Facebook ou Instagam pour prendre un rendez-vous : </p>
        <div class="row mt-3 mb-3">
            <div class="offset-1" >
                <a href="https://www.facebook.com/profile.php?id=100002743732510" target="_blank"><img class="facebook" src="../assets/img/logoFacebook.svg" alt="facebook"/></a>
                <a href="https://www.instagram.com/nailsbeautybyjess_soissons/" target="_blank"><img class="instagram" src="../assets/img/logoInstagram.svg" alt="instagram"/></a>
            </div>
        </div>
        <p>Vous pouvez aussi prendre rendez-vous en m'envoyant un mail en précisant 3 dates auxquelles vous serez disponible, la prestation choisie et vos
            coordonnées. Je reviendrais vers vous et vous proposerais des créneaux horaires, valables 24H.</p>
        <div class="mt-2">
            <p>Contact : <a href="mailto:billecoq-jessica@hotmail.fr">billecoq-jessica@hotmail.fr</a></p>
        </div>
    </div>
</div>
<?php
include '../template/footer.php';
?>