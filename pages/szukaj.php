<?php
	if(isset($_POST['szukaj'])){
		header('Location: ?szukaj='.$_POST['wyrazenie'].'&by='.$_POST['wedlug']);
	}
?>
<h3>Wyszukiwarka</h3>
<div class="row">
	<div class="col-md-3">
		<form action="" method="POST">
			<label for="wedlug">Wyszukaj według:</label>
			<select name="wedlug" id="wedlug" class="form-control">
				<option>Nazwa instrumentu</option>
				<option>Rodzaj instrumentu</option>
				<option>Nazwa rodziny</option>
				<option>Wywodzenie się instrumentu</option>
			</select><br>
			<label for="wyrazenie">Szukane wyrażenie:</label>
			<input type="text" name="wyrazenie" id="wyrazenie" class="form-control"><br>
			<input type="submit" name="szukaj" value="Szukaj" class="btn btn-info">
		</form>
	</div>
</div>