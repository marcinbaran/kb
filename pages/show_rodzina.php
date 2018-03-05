<?php
	echo '<h2>Do Rodziny "'.$_GET['show_rodzina'].'"	 należa rodzaje:</h2>';
	$rows = $function->show_rodzina($_GET['show_rodzina']);
	echo '<h4>';
	foreach ($rows as $row) {
		echo '<a href="?show_rodzaj='.$row->values()[0]->values()['nazwa'].'">'.$row->values()[0]->values()['nazwa'].'</a><br>';
	}
	echo '</h4>';