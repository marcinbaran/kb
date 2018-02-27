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
                	echo '<a href="?show_rodzaj='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
                echo '<br><br><br><br><br><br>';
                break;
            case 'Wywodzenie się instrumentu':
                $query = '  MATCH (n:Państwo)
                            WHERE n.nazwa =~ "(?i).*'.$wyrazenie.'.*"
                            RETURN n.nazwa ORDER BY n.nazwa ';
                $result = $this->db->run($query);
                $rows = $result->records();
                if(empty($rows)){echo '<span style="color: #f96868;">Nic nie znaleziono ...</span>';};
                foreach ($rows as $row) {
                    echo '<a href="?szukaj='.$wyrazenie.'&by='.$wedlug.'&more='.$row->values()[0].'">'.$row->values()[0].'</a><br>';
                }
                echo '<br><br><br><br><br><br>';
                break;
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
									SET n.Skala = "'.$info['skala'].'"
									');
	}

	public function edit_rodzaj($nazwa, $dane){
		$this->db->run('MATCH (n:Rodzaj {nazwa:"'.$nazwa.'"}) SET n.Opis = "'.$dane['edytujopis'].'"');
	}

	public function print_rodzaj(){
		$result = $this->db->run('MATCH (n:Rodzaj) RETURN n.nazwa ORDER BY n.nazwa');
		foreach ($result->records() as $row) {
			echo '<option>'.$row->values()[0].'</option>';
		}
	}

	public function print_rodzina(){
		$result = $this->db->run('MATCH (n:Rodzina) RETURN n.nazwa ORDER BY n.nazwa');
		foreach ($result->records() as $row) {
			echo '<option>'.$row->values()[0].'</option>';
		}
	}

	public function print_podgrupa(){
		$result = $this->db->run('MATCH (n:Podgrupa) RETURN n.nazwa ORDER BY n.nazwa');
		foreach ($result->records() as $row) {
			echo '<option>'.$row->values()[0].'</option>';
		}
	}

	public function print_grupa(){
		$result = $this->db->run('MATCH (n:Grupa) RETURN n.nazwa ORDER BY n.nazwa');
		foreach ($result->records() as $row) {
			echo '<option>'.$row->values()[0].'</option>';
		}
	}

	public function add_new_instrument($dane){
		$nazwa = ucfirst($dane['nazwa']);
		$this->db->run('MERGE (gatunek:Gatunek {nazwa:"'.$nazwa.'", Opis:"'.$dane['opis'].'", Skala:"'.$dane['skala'].'"})
						MERGE (rodzaj:Rodzaj {nazwa:"'.$dane['rodzaj'].'"})
						MERGE (gatunek)-[:instanceof]->(rodzaj)
			');
	}

	public function get_pochodzenie($instrument){
		$result = $this->db->run('	MATCH (n:Gatunek {nazwa:"'.$instrument.'"})
									MATCH (n)-[:wywodzi_się_z]->(p:Państwo)
									MATCH (p)-[:znajduje_sie_w]->(k:Kontynent)
									RETURN n,p,k
			');
		return $result->records();
	}

	public function get_all_kontynent(){
		$result = $this->db->run('MATCH (n:Kontynent) RETURN n');
		$rows = $result->records();
		foreach ($rows as $row) {
			echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
		}
	}

	public function dodaj_nowy_kraj($id, $dane){
		$this->db->run('MATCH (n) WHERE ID(n) = '.$id.'
						MERGE (panstwo:Państwo{nazwa:"'.$dane['panstwo'].'"})
						MERGE (kontynent:Kontynent{nazwa:"'.$dane['kontynent'].'"})
						MERGE (n)-[:wywodzi_się_z]->(panstwo)
						MERGE (panstwo)-[:znajduje_sie_w]->(kontynent)
		');
	}

    public function show_more($by, $more){
        switch ($by){
            case 'Rodzaj instrumentu':
                $query = '  MATCH (n:Rodzaj {nazwa:"'.$more.'"})
                            MATCH (i:Gatunek)-[:instanceof]->(n)
                            RETURN i
                ';
                $result = $this->db->run($query);
                $rows = $result->records();
                foreach ($rows as $row) {
                    echo '<a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a><br>';
                }
                break;

            case 'Wywodzenie się instrumentu':
                $query = '  MATCH (n:Państwo{nazwa:"'.$more.'"}) 
                            MATCH (i:Gatunek)-[:wywodzi_się_z]->(n)
                            RETURN i
                ';
                $result = $this->db->run($query);
                $rows = $result->records();
                foreach ($rows as $row) {
                    echo '<a href="?show='.$row->values()[0]->value('nazwa').'">'.$row->values()[0]->value('nazwa').'</a><br>';
                }
                break;
                break;
        }

    }

    public function show_rodzina($nazwa){
    	$result = $this->db->run('MATCH (n:Rodzina{nazwa:"'.$nazwa.'"})-[:hiperonim]->(m:Rodzaj) RETURN m');
    	return $result->records();
    }

    public function show_podgrupa($nazwa){
    	$result = $this->db->run('MATCH (n:Podgrupa{nazwa:"'.$nazwa.'"})-[:hiperonim]->(m:Rodzina) RETURN m');
    	return $result->records();
    }

    public function show_grupa($nazwa){
    	$result = $this->db->run('MATCH (n:Grupa{nazwa:"'.$nazwa.'"})-[:hiperonim]->(m:Podgrupa) RETURN m');
    	return $result->records();
    }

    public function print_grupa_select(){
	    $result = $this->db->run('MATCH (n:Grupa) return n');
	    $rows = $result->records();
	    foreach ($rows as $row){
	        echo '<option>'.$row->values()[0]->value('nazwa').'</option>';
        }
    }

    public function szukaj_instrument_po_nazwie($nazwa){
	    $result = $this->db->run('MATCH (n:Gatunek)
		 					WHERE n.nazwa =~ "(?i).*'.$nazwa.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa');
	    return $result->records();
    }

    public function szukaj_instrumentow_po_panstwie($nazwa){
	    $result = $this->db->run('MATCH(n:Państwo{nazwa:"'.$nazwa.'"})<-[:wywodzi_się_z]-(m:Gatunek) RETURN m');
	    return $result->records();
    }

    public function pokaz_grupy($nazwa){
        $result = $this->db->run('MATCH (n:Grupa)
		 					WHERE n.nazwa =~ "(?i).*'.$nazwa.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa');
        return $result->records();
    }

    public function pokaz_podgrupy($nazwa){
        $result = $this->db->run('MATCH (n:Podgrupa)
		 					WHERE n.nazwa =~ "(?i).*'.$nazwa.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa');
        return $result->records();
    }

    public function pokaz_rodziny($nazwa){
        $result = $this->db->run('MATCH (n:Rodzina)
		 					WHERE n.nazwa =~ "(?i).*'.$nazwa.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa');
        return $result->records();
    }

    public function pokaz_rodzaje($nazwa){
        $result = $this->db->run('MATCH (n:Rodzaj)
		 					WHERE n.nazwa =~ "(?i).*'.$nazwa.'.*"
		 					RETURN n.nazwa ORDER BY n.nazwa');
        return $result->records();
    }














}