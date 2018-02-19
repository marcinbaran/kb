<?php

	if(isset($_POST['edit'])){
		$function->edit_rodzaj($_GET['show_rodzaj'], $_POST);
		echo '	<div class="alert alert-success">
				  	<strong>Opis został zaktualizowany!</strong>
				</div>';
	}

	$rows = $function->get_all_instrumenct_in_rodzaj($_GET['show_rodzaj']);
	$rows1 = $function->get_all_instrumenct_in_rodzaj1($_GET['show_rodzaj']);
?>
<div class="row">
	<div class="col-md-11"><?php echo '<h1>'.$_GET['show_rodzaj'].'</h1>'; ?></div>
	<div class="col-md-1"><button class="btn btn-info glyphicon glyphicon-chevron-left"></button></a></div>
</div>
<div class="row">
	<div class="col-md-8">
		<h4> 
			<?php
			if(isset($rows1[0]->values()[0]->values()['Opis'])){
				echo $rows1[0]->values()[0]->values()['Opis'];
			}else{
				echo '-';
			}
			?>
		</h4>
		<hr></hr>
		<h4>Wyróżniamy następujące gatunki należące do rodzaju "<?php echo $_GET['show_rodzaj']?>":</h4>
		<ul>
			<?php
				foreach ($rows as $row) {
					echo '<h3><li><a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a></li></h3>';
				}
			?>
		</ul>
	</div>
	<div class="col-md-4">
		<form action="" method="POST">
			<label>Edytuj opis</label>
			<textarea name="edytujopis" class="form-control"><?php
			if(isset($rows1[0]->values()[0]->values()['Opis'])){
				echo $rows1[0]->values()[0]->values()['Opis'];
			}?></textarea><br>
			<input type="submit" name="edit" value="Zapisz" class="btn btn-success">
		</form>
	</div>
</div>
<br><br><br><br><br>