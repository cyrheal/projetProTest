<?php
include '../template/header.php';
include 'sidebar.php';
?>
<div class="col-md-9 mainContent"><!--couleur colonne droite-->
    <div class="ml-3 mt-5"><!--marge left 3 marge top 5-->
        <p>Pour prendre un rendez-vous, vous pouvez : </p>
        <p>me contacter par mesenger sur ma page facebook</p>
        <p>Ensuite, vous devez choisir une prestation et 3 dates auxquelle vous êtes disponible. Je vous enverais un mail avec les crénaux disponible (valable 24h)</p>
        
        <form>
            <div class="form-group">
                <label for="mail">Adresse mail</label>
                <input type="email" class="form-control" id="mail" placeholder="nom@exemple.com">
            </div>
            <div class="form-group">
                <label for="prestation">Choix de la prestation</label>
                <select class="form-control" id="exampleFormControlSelect1">
                    <option>1</option>
                    <option>2</option>
                    <option>3</option>
                    <option>4</option>
                    <option>5</option>
                </select>
            </div>
            <div class="row">
                <div class="form-group col-md-4">
                    <label for="selectDate2">1er choix de la date</label>
                    <select class="form-control" id="selectDate1">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="selectDate3">2ème choix de la date</label>
                    <select class="form-control" id="selectDate2">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
                <div class="form-group col-md-4">
                    <label for="selectDate3">3ème choix de la date</label>
                    <select class="form-control" id="exampleFormControlSelect3">
                        <option>1</option>
                        <option>2</option>
                        <option>3</option>
                        <option>4</option>
                        <option>5</option>
                    </select>
                </div>
            </div>
            <div class="form-group">
                <label for="textarea">Précision (optionnel)</label>
                <textarea class="form-control" id="textarea1" rows="3"></textarea>
            </div>
        </form>
    </div>
</div>
<?php
include '../template/footer.php';
?>