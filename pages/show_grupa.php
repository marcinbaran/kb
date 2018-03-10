<?php
//	echo '<h2>Grupa "'.$_GET['show_grupa'].'" dzieli się na podgrupy:</h2>';
//	$rows = $function->show_grupa($_GET['show_grupa']);
//	echo '<h4>';
//	foreach ($rows as $row) {
//		echo '<a href="?show_podgrupa='.$row->values()[0]->values()['nazwa'].'">'.$row->values()[0]->values()['nazwa'].'</a><br>';
//	}
//	echo '</h4>';
//


?>

<script type="text/javascript">
    function pokaz_rodzinev2(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_rodzinev2:val
            },
            success: function (response) {
                document.getElementById("rodzina").innerHTML=response;
                document.getElementById("rodzina").style.display="inline";
                a = document.getElementById(val);
                a.style.color="red";
            }
        });
    }

    function pokaz_rodzajv2(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_rodzajv2:val
            },
            success: function (response) {
                document.getElementById("rodzaj").innerHTML=response;
                document.getElementById("rodzaj").style.display="inline";
                b = document.getElementById(val);
                b.style.color="red";
            }
        });
    }

    function pokaz_instrumenty(val){
        $.ajax({
            type: 'post',
            url: 'fetch_data.php',
            data: {
                pokaz_instrumenty:val
            },
            success: function (response) {
                document.getElementById("instrument").innerHTML=response;
                document.getElementById("instrument").style.display="inline";
                c = document.getElementById(val);
                c.style.color="red";
            }
        });
    }


</script>


<h2>Przeglądasz grupę: <?php echo $_GET['show_grupa']; ?></h2>

<div class="row">
    <div class="col-md-4">
        <h3>Podrupa:</h3>
        <?php
            $rows = $function->show_grupa($_GET['show_grupa']);
            foreach ($rows as $row){
                echo '<span class="rozwijanie" id="'.$row->values()[0]->values()['nazwa'].'" onclick="pokaz_rodzinev2($(this).text())">'.$row->values()[0]->values()['nazwa'].'</span><br>';
            }
        ?>
    </div>
    <div class="col-md-4" id="rodzina" style="display: none;">
        <h3>Rodzina:</h3>
    </div>
    <div class="col-md-4" id="rodzaj" style="display: none;">
        <h3>Rodzaj:</h3>
    </div>
<!--    <div class="col-md-3" id="instrument" style="display:none;">-->
<!--        <h3>Instrumenty:</h3>-->
<!--    </div>-->
</div>
