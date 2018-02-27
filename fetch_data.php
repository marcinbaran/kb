<?php

	use GraphAware\Neo4j\Client\ClientBuilder;
	require_once(__DIR__.'/vendor/autoload.php');
	require_once('config.php');
	$db	 = ClientBuilder::create()
        ->addConnection('bolt', 'bolt://'.$db_user.':'.$db_pass.'@'.$db_host.':'.$db_port)
        ->build();

	if(isset($_POST['get_option'])){
	    $query = 'MATCH (n:Kontynent{nazwa:"'.$_POST['get_option'].'"})<-[:znajduje_sie_w]->(m) return m';
        $result = $db->run($query);
        $rows = $result->records();
        foreach ($rows as $row) {
            echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
        }
    }

    if(isset($_POST['pokaz_podgrupe'])){
	    $query = 'MATCH(n:Grupa{nazwa:"'.$_POST['pokaz_podgrupe'].'"})-[:hiperonim]->(m:Podgrupa) RETURN m';
        $result = $db->run($query);
        $rows = $result->records();
        echo '<option selected disabled>Wybierz Podgrupę...</option>';
        foreach ($rows as $row) {
            echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
        }
    }

    if(isset($_POST['pokaz_rodzine'])){
        $query = 'MATCH(n:Podgrupa{nazwa:"'.$_POST['pokaz_rodzine'].'"})-[:hiperonim]->(m:Rodzina) RETURN m';
        $result = $db->run($query);
        $rows = $result->records();
        echo '<option selected disabled>Wybierz Rodzinę...</option>';
        foreach ($rows as $row) {
            echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
        }
    }

    if(isset($_POST['pokaz_rodzaj'])){
        $query = 'MATCH(n:Rodzina{nazwa:"'.$_POST['pokaz_rodzaj'].'"})-[:hiperonim]->(m:Rodzaj) RETURN m';
        $result = $db->run($query);
        $rows = $result->records();
        echo '<option selected disabled>Wybierz Rodzinę...</option>';
        foreach ($rows as $row) {
            echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
        }
    }