<script type="text/javascript">
    function pokaz_panstwa(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_panstwa:val
            },
            success: function (response) {
                document.getElementById("panstwo").innerHTML=response;
                document.getElementById("panstwo").style.display="inline";
            }
        });
    }

</script>

<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12" style="text-align: center;margin-top: 40px;"><h2>Szukaj instrument muzyczny po miejscu pochodzenia</h2></div>
</div>

<form action="" method="POST" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-3 col-md-offset-2">
            <select class="form-control" name="kontynent" id="kontynent" onchange="pokaz_panstwa(this.value);">
                <option disabled selected>Wybierz kontynent ...</option>
                <?php $function->get_all_kontynent(); ?>
            </select>
        </div>
        <div class="col-md-3">
            <select class="form-control" name="panstwo" id="panstwo" style="display: none;">
                <option>Wybierz państwo</option>
            </select>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Szukaj" name="szukaj" class="btn btn-info">
        </div>
    </div>
</form>

<?php

//if(isset($_POST['kontynent'])){
//    if(!isset($_POST['panstwo'])){
//        echo '<div class="alert alert-danger">
//                  <strong>Nie wybrano państwa !</strong>
//              </div>';
//    }else{
//        $rows = $function->szukaj_instrumentow_po_panstwie($_POST['panstwo']);
//        if(empty($rows)){
//            echo '<div class="alert alert-danger">
//                  <strong>Nie znaleziono instrumentów pochodzących z państwa: '.$_POST['panstwo'].'</strong>
//              </div>';
//        }else{
//            echo '<h4>Instrumenty pochodzące z państwa '.$_POST['panstwo'].' :</h4>';
//            foreach($rows as $row){
//                echo '<a href="?show='.$row->values()[0]->values()['nazwa'].'">'.$row->values()[0]->values()['nazwa'].'</a><br>';
//            }
//        }
//    }
//}

if(isset($_POST['szukaj'])){
    if(!isset($_POST['panstwo']) || empty($_POST['panstwo'])) {
        echo '<div class="alert alert-danger">
                  <strong>Nie wybrano państwa !</strong>
              </div>';
    }else{
?>

        <div class="row">
            <div class="col-md-4 col-md-offset-2">
                <h4>Gatunki:</h4>
                <?php
                    $rows = $function->szukaj_instrumentow_po_panstwie($_POST['panstwo']);
                    if(empty($rows)){
                        echo 'Nic nie znaleziono ...';
                    }else {
                        foreach ($rows as $row) {
                            echo '<a href="?show=' . $row->values()[0]->values()['nazwa'] . '">' . $row->values()[0]->values()['nazwa'] . '</a><br>';
                        }
                    }
                ?>
            </div>
            <div class="col-md-4">
                <h4>Rodzaje:</h4>
                    <?php
                        $rows = $function->szukaj_rodzajow_po_panstwie($_POST['panstwo']);
                        if(empty($rows)){
                            echo 'Nic nie znaleziono ...';
                        }else {
                            foreach ($rows as $row) {
                                echo '<a href="?show_rodzaj=' . $row->values()[0]->values()['nazwa'] . '">' . $row->values()[0]->values()['nazwa'] . '</a><br>';
                            }
                        }
                    ?>
            </div>
        </div>


<?php
    }
}