<?php

	if(isset($_POST['submit'])){
		$function->update_instrument_info($_GET['edit'], $_POST);
		echo '	<div class="alert alert-success">
					<strong>Dane zostały zaktualizowane pomyślnie!</strong>
				</div>';
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

	if(isset($row[0]->values()[0]->values()['Kształt'])){
		$ksztalt = $row[0]->values()[0]->values()['Kształt'];
	}else{
		$ksztalt = "";
	}
?>
<div class="row">
	<div class="col-md-4">
		<form action="" method="POST">
			<label for="nazwa_instrumentu">Nazwa instrumentu:</label>
			<input type="text" id="nazwa_instrumentu" name="nazwa_instrumentu" class="form-control" value="<?php echo $row[0]->values()[0]->values()['nazwa']; ?>" ><br>
			<label for="opis">Opis:</label>
			<textarea name="opis" class="form-control"><?php echo $opis; ?></textarea><br>
			<label for="ksztalt">Kształt:</label>
			<textarea name="ksztalt" class="form-control"><?php echo $ksztalt; ?></textarea><br>
			<label for="skala">Skala:</label>
			<textarea name="skala" class="form-control"><?php echo $skala; ?></textarea><br>
			<input type="submit" name="submit" value="Zapisz" class="btn btn-success">
		</form>
	</div>
</div>