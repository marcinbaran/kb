<?php
	echo '<h2>Grupa "'.$_GET['show_grupa'].'" dzieli się na podgrupy:</h2>';
	$rows = $function->show_grupa($_GET['show_grupa']);
	echo '<h4>';
	foreach ($rows as $row) {
		echo '<a href="?show_podgrupa='.$row->values()[0]->values()['nazwa'].'">'.$row->values()[0]->values()['nazwa'].'</a><br>';
	}
	echo '</h4>';