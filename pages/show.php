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
	<div class="col-md-4">ZDJĘCIE JEŚLI ISTNIEJE</div>
</div>