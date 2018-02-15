<?php

use GraphAware\Neo4j\Client\ClientBuilder;

class Function_C{

	public $db;

	public function __construct(){
		require_once(__DIR__.'/vendor/autoload.php');
		require_once('config.php');
		$this->db = ClientBuilder::create()
		->addConnection('bolt', 'bolt://'.$db_user.':'.$db_pass.'@'.$db_host.':'.$db_port)
		->build();
	}


	public function get(){
		$result = $this->db->run('MATCH (n) RETURN n');
		return $result;
	}

	public function search($wyrazenie=NULL, $wedlug=NULL){
		switch ($wedlug) {
			case 'Nazwa instrumentu':
				$query = '	MATCH (n:Gatunek)
		 					WHERE n.nazwa =~ "(?i).*'.$wyrazenie.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa';
		 		$result = $this->db->run($query);
		 		$rows = $result->records();
		 		if(empty($rows)){echo '<span style="color: #f96868;">Nic nie znaleziono ...</span>';};
				foreach ($rows as $row) {
					echo '<a href="?show='.$row->values()[0].'" style="color:#0000ff">'.$row->values()[0].'</a><br>';
				}
				echo '<br><br><br>';
				break;
			case 'Rodzaj instrumentu':
			$query = 'MATCH (n:Rodzaj)
		 					WHERE n.nazwa =~ "(?i).*'.$wyrazenie.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa';
		 	$result = $this->db->run($query);
		 	$rows = $result->records();
		 	if(empty($rows)){echo '<span style="color: #f96868;">Nic nie znaleziono ...</span>';};
		 	foreach ($rows as $row) {
		 		echo $row->values()[0].'<br>';
		 		//print_r($row);
		 	}
		 	echo '<br><br><br><br><br><br>';
		 	//print_r($result);
		}
	}

	public function get_all_instruments($limit, $skip){
		$result = $this->db->run('	MATCH (n:Gatunek) 
									MATCH (n)-[:instanceof]->(r:Rodzaj)
									MATCH (r)-[:hiponim]->(d:Rodzina)
									MATCH (d)-[:hiponim]->(podgrupa:Podgrupa)
									MATCH (podgrupa)-[:hiponim]->(grupa:Grupa)
									RETURN n,r,d, podgrupa, grupa ORDER BY n.nazwa 
									SKIP '.$skip.' LIMIT '.$limit.'');
		return $result->records();
	}

	public function get_instruments_count(){
		$result = $this->db->run('MATCH (n:Gatunek) RETURN COUNT(n)');
		return $result->getRecords()[0]->values()[0];
	}

	public function delete_instrument($id){
		$this->db->run('MATCH (m:Gatunek) where ID(m)='.$id.'
						OPTIONAL MATCH (m)-[r]-()
						DELETE r,m');
	}

	public function get_info_about($instrument){
		$result = $this->db->run('	MATCH (n:Gatunek {nazwa:"'.$instrument.'"}) 
									MATCH (n)-[:instanceof]->(r:Rodzaj)
									MATCH (r)-[:hiponim]->(rodzina:Rodzina)
									MATCH (rodzina)-[:hiponim]->(podgrupa:Podgrupa)
									MATCH (podgrupa)-[:hiponim]->(grupa:Grupa)
									RETURN n,r, rodzina, podgrupa, grupa');
		return $result->records();
	}

	public function get_origin($rodzaj){
		$result = $this->db->run('	MATCH (n:Rodzaj {nazwa:"'.$rodzaj.'"})
									MATCH (n)-[:wywodzi_się_z]->(p:`Państwo`)
									MATCH (p)-[:znajduje_sie_w]->(k:Kontynent)
									RETURN n,p,k
			');
		return $result->records(); 
	}

	public function get_all_instrumenct_in_rodzaj($rodzaj){
		$result = $this->db->run('	MATCH (n:Rodzaj {nazwa:"'.$rodzaj.'"})
									MATCH (g:Gatunek)-[:instanceof]->(n:Rodzaj)
									RETURN g
			');
		return $result->records();
	}

	public function get_all_instrumenct_in_rodzaj1($rodzaj){
		$result = $this->db->run('	MATCH (n:Rodzaj {nazwa:"'.$rodzaj.'"})
									RETURN n
			');
		return $result->records();
	}

	public function info_about_instrument($id){
		$result = $this->db->run('MATCH (n:Gatunek) WHERE ID(n)='.$id.' RETURN n');
		return $result->records();
	}

	public function update_instrument_info($id, $info){
		$result = $this->db->run('	MATCH (n:Gatunek) 
									WHERE ID(n)='.$id.'
									SET n.nazwa = "'.$info['nazwa_instrumentu'].'"
									SET n.Opis = "'.$info['opis'].'"
									SET n.Kształt = "'.$info['ksztalt'].'"
									SET n.Skala = "'.$info['skala'].'"
									');
	}


}