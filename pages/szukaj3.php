<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12" style="text-align: center;margin-top: 40px;"><h2>Szukaj po nazwie grupy, podgrupy, rodziny, rodzaju</h2></div>
</div>

<form action="" method="POST" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-4 col-md-offset-3">
            <input type="text" name="nazwa" class="form-control" placeholder="Nazwa grupy, podgrupy, rodziny, rodzaju ..." required>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Szukaj" class="btn btn-info">
        </div>
    </div>
</form>


<?php
    if(isset($_POST['nazwa'])) {
?>

<div class="row">
    <div class="col-md-3">
        <h4>Znalezione grupy:</h4>
        <?php
            $rows = $function->pokaz_grupy($_POST['nazwa']);
            if(empty($rows)){
                echo 'Nic nie znaleziono ...';
            }else{
                foreach ($rows as $row){
                    echo '<a href="?show_grupa='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
            }
        ?>
    </div>
    <div class="col-md-3">
        <h4>Znalezione podgrupy:</h4>
        <?php
            $rows = $function->pokaz_podgrupy($_POST['nazwa']);
            if(empty($rows)){
                echo 'Nic nie znaleziono ...';
            }else{
                foreach ($rows as $row){
                    echo '<a href="?show_podgrupa='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
            }
        ?>
    </div>
    <div class="col-md-3">
        <h4>Znalezione rodziny:</h4>
        <?php
            $rows = $function->pokaz_rodziny($_POST['nazwa']);
            if(empty($rows)){
                echo 'Nic nie znaleziono ...';
            }else{
                foreach ($rows as $row){
                    echo '<a href="?show_rodzina='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
            }
        ?>
    </div>
    <div class="col-md-3">
        <h4>Znalezione rodzaje:</h4>
        <?php
            $rows = $function->pokaz_rodzaje($_POST['nazwa']);
            if(empty($rows)){
                echo 'Nic nie znaleziono ...';
            }else{
                foreach ($rows as $row){
                    echo '<a href="?show_rodzaj='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
            }
        ?>
    </div>
</div>
<br><br><br><br>

<?php
    }
?>
