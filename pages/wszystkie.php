<?php

	if(isset($_GET['delete'])){
		$function->delete_instrument($_GET['delete']);
		header('Location: ?wszystkie');
	}

	$total = $function->get_instruments_count();
	$total = $total-23;
	$limit = 20;
	$pages = ceil($total / $limit);
	$page = min($pages, filter_input(INPUT_GET, 'page', FILTER_VALIDATE_INT, array(
	        'options' => array(
	            'default'   => 1,
	            'min_range' => 1,
	        ),
	    )));
	$skip = ($page - 1) * $limit;
	$start = $skip + 1;
?>


<div class="table-responsive">
	<table class="table">
		<thead>
			<tr>
				<th>L.p</th>
				<th>Nazwa instrumentu</th>
				<th>Rodzaj</th>
				<th>Rodzina</th>
				<th>Podgrupa</th>
				<th>Grupa</th>
				<th><center>Akcja</center></th>
			</tr>
		</thead>
		<tbody>
			<?php
				$i = $start;
				$rows = $function->get_all_instruments($limit, $skip);
				foreach ($rows as $row) {
					echo '<tr>';
					echo '<td>'.$i.'</td>';
					echo '<td><a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a></td>';
					echo '<td>'.$row->values()[1]->value('nazwa').'</td>';
					echo '<td>'.$row->values()[2]->value('nazwa').'</td>';
					echo '<td>'.$row->values()[3]->value('nazwa').'</td>';
					echo '<td>'.$row->values()[4]->value('nazwa').'</td>';
					echo '<td><a href="?wszystkie&delete='.$row->values()[0]->identity().'"><button class="btn btn-danger">Usuń</button></a></td>';
					echo '</tr>';
					$i++;
				}
				
			?>
		</tbody>
	</table>
</div>


<center><ul class="pagination">
	<?php
		for($i=1; $i<=$pages; $i++){
			if(empty($_GET['page']) && $i==1){
				echo '<li class="active"><a href="?wszystkie&page='.$i.'">'.$i.'</a></li>';
			}
			elseif(isset($_GET['page']) && $_GET['page'] == $i){
				echo '<li class="active"><a href="?wszystkie&page='.$i.'">'.$i.'</a></li>';
			}else{
				echo '<li class=""><a href="?wszystkie&page='.$i.'">'.$i.'</a></li>';
			}
		}
	?>
</ul>
</center>



<br><br><br>
