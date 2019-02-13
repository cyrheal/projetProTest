<?php
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-12 col-lg-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <p>Points fidélité : </p>
        <div class="form-group col-md-4">
            <label for="inputState">Client</label>
            <select id="inputState" class="form-control">
                <option selected>Choisir...</option>
                <option>...</option>
            </select>
        </div>
        <input type="number" />
        <p>Rendez-vous</p>
    </div>
</div>
<?php
include '../template/footer.php';
?>