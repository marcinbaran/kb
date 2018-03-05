<div class="row" style="margin-bottom: 30px;">
    <div class="col-md-12" style="text-align: center;margin-top: 40px;"><h2>Wyszukaj instrument muzyczny wg. nazwy</h2></div>
</div>

<form action="" method="POST" style="margin-bottom: 50px;">
    <div class="row">
        <div class="col-md-3 col-md-offset-4">
            <input type="text" name="nazwa_instrumentu" class="form-control" placeholder="Nazwa instrumentu ..." required>
        </div>
        <div class="col-md-3">
            <input type="submit" value="Szukaj" class="btn btn-info">
        </div>
    </div>
</form>

<?php
    if(isset($_POST['nazwa_instrumentu'])){
        echo '<h4>Szukasz instrumentu: '.$_POST['nazwa_instrumentu'].'</h4>';
        $rows = $function->szukaj_instrument_po_nazwie($_POST['nazwa_instrumentu']);
        $liczba = $function->szukaj_instrument_po_nazwie_liczba($_POST['nazwa_instrumentu']);
        if(empty($rows)){
            echo '<div class="alert alert-danger">
                  <strong>Nie znaleziono żadnego instrumentu zawierającego wprowadzone wyrażenie !</strong>
              </div>';
        }else{
            if($liczba[0]->values()[0] == 1){
                header('Location: ?show='.$rows[0]->values()[0]);
            }
            foreach ($rows as $row){
                echo '<a href="?show='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
            }
        }
    }


    echo '<br><br><br><br>';