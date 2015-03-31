<?php

/* 
 * @Dev Luis Perera
 */

class indexModel extends Model{
    public function __construct() {
        parent::__construct();
    }
    
    public function getNumEmpresas(){
    	$data = array('TABLE'=>'empresas','COLUMNS'=>'*','WHERE'=>'id > 0 LIMIT 1');
    	$select = $this->_dbf->get_select_query($data);
    	$q = $this->_db->query($select);
    	if ($q) 
    		return $q->fetch(PDO::FETCH_NUM);
    }

    public function getNumFacturas(){
    	$data = array('TABLE'=>'facturas','COLUMNS'=>'*','WHERE'=>'id > 0 LIMIT 1');
    	$select = $this->_dbf->get_select_query($data);
    	$q = $this->_db->query($select);
    	if ($q) 
    		return $q->fetch(PDO::FETCH_NUM);
    }
}
