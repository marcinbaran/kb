<?php
	if(isset($_POST['dodaj'])){
		$function->add_new_instrument($_POST);
	}
?>
<form action="" method="POST">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-4">
				<label>Nazwa instrumentu:</label>
				<input type="text" name="nazwa" class="form-control"><br>
				<label>Opis instrumentu:</label>
				<textarea name="opis" class="form-control"></textarea><br>
				<label>Skala instrumentu:</label>
				<textarea name="skala" class="form-control"></textarea><br>
		</div>
		<div class="col-md-4">
			<label>Rodzaj instrumentu:</label>
			<select name="rodzaj" class="form-control">
				<?php $function->print_rodzaj(); ?>
			</select><br>
			<label>Rodzina instrumentu:</label>
			<select name="rodzina" class="form-control">
				<?php $function->print_rodzina(); ?>
			</select><br>
			<label>Pogrupa:</label>
			<select name="podgrupa" class="form-control">
				<?php $function->print_podgrupa(); ?>
			</select><br>
			<label>Grupa:</label>
			<select name="grupa" class="form-control">
				<?php $function->print_grupa(); ?>
			</select>
		</div>
		<div class="col-md-2"></div>
	</div>
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-2">
			<br><input type="submit" name="dodaj" value="Dodaj" class="btn btn-success">
		</div>
	</div>
</form>