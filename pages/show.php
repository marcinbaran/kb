<?php
	$row = $function->get_info_about($_GET['show']);
	$rodzaj = $row[0]->values()[1]->value('nazwa');
	$pochodzenie = $function->get_origin($rodzaj);
?>
<div class="row">
	<div class="col-md-11"><?php echo '<h2>'.$_GET['show'].'</h2>'; ?></div>
	<div class="col-md-1"><a href="javascript:history.go(-1);"><button class="btn btn-default btn1n">Wróć</button></a></div>
</div>

<div class="row">
	<div class="col-md-4">
		<?php
			if(file_exists('./img/instruments/'.$_GET['show'].'.png')){
				echo '<center><img src="./img/instruments/'.$_GET['show'].'.png" class="img-responsive img-thumbnail" ></center>';
			}else{
				echo '<center><img src="/img/instruments/brak_zdjecia.png" class="img-responsive img-thumbnail"></center>';
			}
		?>
		<h5>Nazwa: <?php echo $_GET['show']; ?></h5>
		<h5>Rodzaj: <?php echo $row[0]->values()[1]->value('nazwa'); ?></h5>
		<h5>Rodzina: <?php echo $row[0]->values()[2]->value('nazwa'); ?></h5>
		<h5>Podgrupa: <?php echo $row[0]->values()[3]->value('nazwa'); ?></h5>
		<h5>Grupa: <?php echo $row[0]->values()[4]->value('nazwa'); ?></h5>
		<br>
	</div>
	<div class="col-md-8">
		<h3>Pochodzenie instrumentu:</h3>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Państwo</th>
						<th>Kontynent</th>
					</tr>
				</thead>
				<tbody>
							<?php
							if(isset($pochodzenie[0])){
								echo '<tr><td>';
								echo $pochodzenie[0]->values()[1]->value('nazwa');
								echo '</td>';
							}
							?>
							<?php
							if(isset($pochodzenie[0])){
								echo '<td>';
								echo $pochodzenie[0]->values()[2]->value('nazwa');
								echo '</td></tr>';
							}
							?>
					<?php
						$poch2 = $function->get_pochodzenie($_GET['show']);
						foreach ($poch2 as $poch) {
							echo '<tr>';
							if(isset($poch->values()[1])){
								echo '<td>'.$poch->values()[1]->value('nazwa').'</td>';
							}
							if(isset($poch->values()[2])){
								echo '<td>'.$poch->values()[2]->value('nazwa').'</td>';
							}
							echo '</tr>';
						}
					?>
				</tbody>
			</table>
		</div>
		<hr></hr>
		<h3>Opis</h3>
		<?php
			if(isset($row[0]->values()[0]->values()['Opis'])){
				echo $row[0]->values()[0]->values()['Opis'];
			}else{
				echo '-';
			} 
		?>
		<hr></hr>
		<h3>Skala</h3>
		<?php
			if(isset($row[0]->values()[0]->values()['Skala'])){
				echo $row[0]->values()[0]->values()['Skala'];
			}else{
				echo '-';
			} 
		?>
	</div>
</div>
<br><br><br><br><br><br>