<?php

	if(isset($_POST['submit'])){
		$function->update_instrument_info($_GET['edit'], $_POST);
		echo '	<div class="alert alert-success">
					<strong>Dane zostały zaktualizowane pomyślnie!</strong>
				</div>';
	}

	if(isset($_GET['delete'])){
        $function->usun_pochodzenie($_GET['delete']);
        echo '	<div class="alert alert-success">
					<strong>Państwo usunięto pomyślnie!</strong>
				</div>';
    }

	if(isset($_POST['dodajkraj'])){
		$function->dodaj_nowy_kraj($_GET['edit'], $_POST);
	}

	$row = $function->info_about_instrument($_GET['edit']);

	if(isset($row[0]->values()[0]->values()['Opis'])){
		$opis = $row[0]->values()[0]->values()['Opis'];
	}else{
		$opis = "";
	}

	if(isset($row[0]->values()[0]->values()['Skala'])){
		$skala = $row[0]->values()[0]->values()['Skala'];
	}else{
		$skala = "";
	}

?>

<script type="text/javascript">
    function fetch_select(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                get_option:val
            },
            success: function (response) {
                document.getElementById("panstwo").innerHTML=response;
            }
        });
    }
</script>


<div class="row">
	<div class="col-md-4">
		<h3>Informacje ogólne:</h3><br>
		<form action="" method="POST">
			<label for="nazwa_instrumentu">Nazwa instrumentu:</label>
			<input type="text" id="nazwa_instrumentu" name="nazwa_instrumentu" class="form-control" value="<?php echo $row[0]->values()[0]->values()['nazwa']; ?>" ><br>
			<label for="opis">Opis:</label>
			<textarea name="opis" class="form-control" rows="7"><?php echo $opis; ?></textarea><br>
			<label for="skala">Skala:</label>
			<textarea name="skala" class="form-control" rows="1"><?php echo $skala; ?></textarea><br>
			<input type="submit" name="submit" value="Zapisz" class="btn btn-success">
		</form>
	</div>
	<div class="col-md-1"></div>
	<div class="col-md-6">
		<h3>Dodaj pochodzenie instrumentu:</h3><br>
		<form action="" method="POST">
			<label>Kontynent:</label>
			<select name="kontynent" id="kontynent" class="form-control" onchange="fetch_select(this.value);">
				<option disabled selected>Wybierz kontynent</option>
				<?php $function->get_all_kontynent(); ?>
			</select><br>
			<label for="panstwo">Państwo:</label>
			<select name="panstwo" id="panstwo" class="form-control">
				
			</select><br>
			<input type="submit" name="dodajkraj" value="Dodaj" class="btn btn-success">
		</form>

        <br><br>
        <h3>Pochodzenie instrumentu:</h3>
        <div class="table-responsive">
            <table class="table">
                <thead>
                <tr>
                    <th>Państwo</th>
                    <th>Kontynent</th>
                    <th>Akcja</th>
                </tr>
                </thead>
                <tbody>
                <?php
                    $poch2 = $function->get_pochodzenie($row[0]->values()[0]->values()['nazwa']);
                    foreach ($poch2 as $poch) {
                        echo '<tr>';
                        if(isset($poch->values()[1])){
                            echo '<td>'.$poch->values()[1]->value('nazwa').'</td>';
                        }
                        if(isset($poch->values()[2])){
                            echo '<td>'.$poch->values()[2]->value('nazwa').'</td>';
                        }
                        echo '<td><a href="?edit='.$_GET['edit'].'&delete='.$poch->values()[3].'"><button class="btn btn-danger" style="padding:0px;">USUŃ</button></a></td>';
                        echo '</tr>';
                    }
                ?>
                </tbody>
            </table>
	</div>
<!--	<div class="col-md-1"><a href="javascript:history.go(-1);"><button class="btn btn-info glyphicon glyphicon-chevron-left"></button></a></div>-->
</div>
</div>
<br><br><br><br><br>