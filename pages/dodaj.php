<?php
	if(isset($_POST['dodaj'])){
	    if(!isset($_POST['rodzaj'])){
            echo '<div class="alert alert-danger">
                  <strong>Wybierz rodzaj instrumentu muzycznego !</strong>
              </div>';
        }else{
            $function->add_new_instrument($_POST);
            echo '<div class="alert alert-success">
                  <strong>Instrument został dodany !</strong>
              </div>';
        }
	}
?>

<script type="text/javascript">
    function pokaz_podgrupe(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_podgrupe:val
            },
            success: function (response) {
                document.getElementById("podgrupa").innerHTML=response;
                document.getElementById("podgrupa_instrumentu").style.display="inline";
            }
        });
    }

    function pokaz_rodzine(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_rodzine:val
            },
            success: function (response) {
                document.getElementById("rodzina").innerHTML=response;
                document.getElementById("rodzina_instrumentu").style.display="inline";
            }
        });
    }

    function pokaz_rodzaj(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_rodzaj:val
            },
            success: function (response) {
                document.getElementById("rodzaj").innerHTML=response;
                document.getElementById("rodzaj_instrumentu").style.display="inline";
            }
        });
    }
</script>


<form action="" method="POST">
	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-4">
				<label>Nazwa instrumentu:</label>
				<input type="text" name="nazwa" class="form-control"><br>
				<label>Opis instrumentu:</label>
				<textarea name="opis" class="form-control" rows="7"></textarea><br>
				<label>Skala instrumentu:</label>
				<textarea name="skala" class="form-control"></textarea><br>
		</div>
		<div class="col-md-4">
            <label>Grupa instrumentu:</label>
            <select class="form-control" name="grupa" onchange="pokaz_podgrupe(this.value);">
                <option disabled selected>Wybierz grupę</option>
                <?php $function->print_grupa_select(); ?>
            </select><br>
            <span id="podgrupa_instrumentu" style="display: none">
                <label>Podgrupa</label>
                <select class="form-control" name="podgrupa" id="podgrupa" onchange="pokaz_rodzine(this.value);">
                </select><br>
            </span>
            <span id="rodzina_instrumentu" style="display: none">
            <label>Rodzina</label>
            <select class="form-control" id="rodzina" name="rodzina" onchange="pokaz_rodzaj(this.value);">
            </select><br>
            </span>
            <span id="rodzaj_instrumentu" style="display: none">
            <label>Rodzaj</label>
            <select class="form-control" id="rodzaj" name="rodzaj">
            </select>
            </span>
		</div>
		<div class="col-md-2"></div>
	</div>

	<div class="row">
		<div class="col-md-2"></div>
		<div class="col-md-2">
			<br><input type="submit" name="dodaj" value="Dodaj" class="btn btn-success">
		</div>
	</div>
</form>