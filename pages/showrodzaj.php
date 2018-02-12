<?php
	$rows = $function->get_all_instrumenct_in_rodzaj($_GET['show_rodzaj']);
	$rows1 = $function->get_all_instrumenct_in_rodzaj1($_GET['show_rodzaj']);
?>
<h4>Opis: 
	<?php
	if(isset($rows1[0]->values()[0]->values()['Opis'])){
		echo $rows1[0]->values()[0]->values()['Opis'];
	}else{
		echo '-';
	}
	?>
</h4>
<hr></hr>
<h4>W skład rodzaju "<?php echo $_GET['show_rodzaj']?>" wchodzi/ą:</h4>
<ul>
	<?php
		foreach ($rows as $row) {
			echo '<h3><li><a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a></li></h3>';
		}
	?>
</ul>
<br><br><br><br><br>