<?php
	$row = $function->get_info_about($_GET['show']);
	echo '<h2>Informacje o instrumencie: '.$_GET['show'].'</h2>';
?>
<div class="row">
	<div class="col-md-8">
		<h4>Nazwa: <?php echo $_GET['show']; ?></h4>
		<h4>Rodzaj: <?php echo $row[0]->values()[1]->value('nazwa'); ?></h4>
		<h4>Rodzina: <?php echo $row[0]->values()[2]->value('nazwa'); ?></h4>
		<h4>Podgrupa: <?php echo $row[0]->values()[3]->value('nazwa'); ?></h4>
		<h4>Grupa: <?php echo $row[0]->values()[4]->value('nazwa'); ?></h4>
	</div>
	<div class="col-md-4">
		<?php
			echo '<h4 style="text-align: center;">'.$_GET['show'].'</h4>';
			if(file_exists('./img/instruments/'.$_GET['show'].'.png')){
				echo '<center><img src="./img/instruments/'.$_GET['show'].'.png" class="img-responsive img-thumbnail" ></center>';
			}else{
				echo '<center><img src="/img/instruments/brak_zdjecia.png" class="img-responsive img-thumbnail"></center>';
			}
		?>
	</div>
</div>