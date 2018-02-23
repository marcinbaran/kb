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

?>