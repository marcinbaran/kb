<?php
	$rows = $function->get_all_instrumenct_in_rodzaj($_GET['show_rodzaj']);
?>

<h4>W skład rodzaju "<?php echo $_GET['show_rodzaj']?>" wchodzi/ą:</h4>
<ul>
	<?php
		foreach ($rows as $row) {
			echo '<h3><li><a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a></li></h3>';
		}
	?>
</ul>