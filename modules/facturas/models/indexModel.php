<?php

/*
 * @Dev Luis Perera
 */

class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getNumEmpresas() {
		$this->_dbf->select_query('empresas', array('*'), array('id' => '>'), array(0), 'LIMIT 1');
		return $this->_dbf->sql_get_assoc();
	}

	public function getNumFacturas() {
		$this->_dbf->select_query('facturas', array('*'), array('id' => '>'), array(0),'LIMIT 1');
		return $this->_dbf->sql_get_assoc();
	}
}
