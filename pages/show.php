<?php
	$row = $function->get_info_about($_GET['show']);
	echo '<h2>Informacje o: '.$_GET['show'].'</h2>';


	print_r($row);