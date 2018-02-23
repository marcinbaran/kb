<?php
	echo '<h2>Do podgrupy "'.$_GET['show_podgrupa'].'" zalicza się rodziny:</h2>';
	$rows = $function->show_podgrupa($_GET['show_podgrupa']);
	echo '<h4>';
	foreach ($rows as $row) {
		echo '<a href="?show_rodzina='.$row->values()[0]->values()['nazwa'].'">'.$row->values()[0]->values()['nazwa'].'</a><br>';
	}
	echo '</h4>';