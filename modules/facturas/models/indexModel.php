<?php

/*
 * @Dev Luis Perera
 */

class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getNumEmpresas() {
		$this->_dbf->select_query('empresas', array('*'), array('id' => '>'), 'LIMIT 1', array(0));
		return $this->_dbf->sql_get_list();
	}

	public function getNumFacturas() {
		$this->_dbf->select_query('facturas', array('*'), array('id' => '>'), 'LIMIT 1', array(0));
		return $this->_dbf->sql_get_list();
	}
}
