<?php
	//sprawdzanie czy istnieje glowna klasa z funkcjami
	if(file_exists('function.php')){
		//przywolanie klasy
		require_once('function.php');
		//tworzenie obiektu klasy
		$function = new Function_C();
	}else{
		//wyrzucanie errora i zamykanie apliakcji
		echo 'Not found Main Class';
		exit();
	}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
	<title>Instrumenty Muzyczne</title>
	<link rel="stylesheet" href="css/bootstrap.css?<?php echo time();?>">
	<link rel="stylesheet" href="css/style.css?<?php echo time();?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta charset="utf-8">
</head>
<body>
	<!-- Pasek nawigacji -->
	<nav class="navbar navbar-default navbar-fixed-top">
		<div class="container">
			<div class="navbar-header">
				<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="/">Instrymenty muzyczne</a>
			</div>
			<div id="navbar" class="navbar-collapse collapse">
				<ul class="nav navbar-nav">
					<li class="<?php if(empty($_GET)){echo 'active';}else{echo '';} ?>"><a href="/">Strona główna</a></li>
					<li class="<?php if(isset($_GET['wszystkie'])){echo 'active';}else{echo '';} ?>"><a href="?wszystkie">Wszystkie instrumenty</a></li>
					<li class="<?php if(isset($_GET['dodaj'])){echo 'active';}else{echo '';} ?>"><a href="?dodaj">Dodaj instrument</a></li>
<!--					<li class="--><?php //if(isset($_GET['szukaj'])){echo 'active';}else{echo '';} ?><!--"><a href="?szukaj">Szukaj</a></li>-->
                    <li class="dropdown <?php if(isset($_GET['produkty']) || isset($_GET['choroby']) || isset($_GET['diety'])){echo 'active';}?>">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">Szukaj<span class="caret"></span>
                        </a>
                        <ul class="dropdown-menu">
                            <li><a href="?szukaj1">Instrument muzyczny po nazwie</a></li>
                            <li><a href="?szukaj2">Instrumenty z wybranego kraju</a></li>
                            <li><a href="?szukaj3">Po grupie, podgrupie, rodzinie lub rodzaju</a></li>
                        </ul>
                    </li>
                </ul>
<!-- 				<ul class="nav navbar-nav navbar-right">            
					<form class="navbar-form navbar-left" action="" method="GET">
						<label for="search">Słowo klucz:</label>
						<div class="form-group">
							<input type="text" class="form-control" placeholder="Nazwa instrumentu" name="search" id="search" style="width: 350px;">
						</div>
						<button class="btn btn-default" type="submit">
							<i class="glyphicon glyphicon-search"></i>
						</button>
					</form>
				</ul> -->
			</div>
		</div>
	</nav>


	<!-- Strona z zawwartością i kontrolery -->
	<div class="container content1">
		<?php

			if(empty($_GET)){
				require_once('pages/glowna.php');
			}
			if(isset($_GET['wszystkie'])){
				require_once('pages/wszystkie.php');
			}
			if(isset($_GET['dodaj'])){
				require_once('pages/dodaj.php');
			}
//			if(isset($_GET['szukaj'])){
//				if(empty($_GET['szukaj'])){
//					require_once('pages/szukaj.php');
//				}else{
//					require_once('pages/showszukaj.php');
//				}
//
//			}
			if(isset($_GET['show'])){
				require_once('pages/show.php');
			}
			if(isset($_GET['show_rodzaj'])){
				require_once('pages/showrodzaj.php');
			}
			if(isset($_GET['edit'])){
				require_once('pages/edit.php');
			}
			if(isset($_GET['show_rodzina'])){
				require_once('pages/show_rodzina.php');
			}
			if(isset($_GET['show_podgrupa'])){
				require_once('pages/show_podgrupa.php');
			}
			if(isset($_GET['show_grupa'])){
				require_once('pages/show_grupa.php');
			}
			if(isset($_GET['szukaj1'])){
			    require_once('pages/szukaj1.php');
            }
            if(isset($_GET['szukaj2'])){
                require_once('pages/szukaj2.php');
            }
            if(isset($_GET['szukaj3'])){
                require_once('pages/szukaj3.php');
            }
			?>
	</div>




	<!-- Stopka -->
	<div class="footer">
    	Copyright &copy 2018 Krystian Błajda<br>
	</div>
	

	<script type="text/javascript" src="js/jquery.js"></script>
	<script type="text/javascript" src="js/bootstrap.js"></script>
</body>
</html>