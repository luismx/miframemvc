<?php

/* 
 * @Dev Luis Perera
 */

class indexModel extends Model{
    public function __construct() {
        parent::__construct();
    }

    public function getColumnas($tabla){
    	return $this->_dbf->sql_get_nombreColumnas($tabla);
    }

    public function getNumEmpresas(){
    	$data = array('TABLE'=>'empresas','COLUMNS'=>'*','WHERE'=>'id > 0 LIMIT 1');
    	$select = $this->_dbf->get_select_query($data);
    	$q = $this->_db->query($select);
		if ($q) 
			return $q->fetch(PDO::FETCH_NUM);
    }
}

