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
		<h3>Wywodzenie się instrumentu:</h3>
		<div class="table-responsive">
			<table class="table">
				<thead>
					<tr>
						<th>Państwo</th>
						<th>Kontynent</th>
					</tr>
				</thead>
					<tr>
						<td>
							<?php
							if(isset($pochodzenie[0])){
								echo $pochodzenie[0]->values()[1]->value('nazwa');
							}else{
								echo '-';
							} 
								 
							?>
						</td>
						<td>
							<?php
							if(isset($pochodzenie[0])){
								echo $pochodzenie[0]->values()[2]->value('nazwa');
							}else{
								echo '-';
							} 
								 
							?>
					</tr>
				<tbody>
				</tbody>
			</table>
		</div>
		<hr></hr>
		<h3>Opis</h3>
		<hr></hr>
		<h3>Kształt</h3>
		<hr></hr>
		<h3>Skala</h3>
	</div>
</div>
<br><br><br><br><br><br>