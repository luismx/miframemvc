<?php

/*
 * @Dev Luis Perera
 */
class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getDatosUsuario($tabla, $columnas, $where, $data) {
		$this->_dbf->select_query($tabla, $columnas, $where, $data);
		return $this->_dbf->sql_get_assoc();

	}

	public function setDato($columna, $valor, $id) {
		$this->_dbf->update_query('usuarios', array($columna => '='), array('id' => '='), '', array($valor, $id));
		return $this->_dbf->get_affected_rows();
	}

	public function getSession($id) {
		$this->_dbf->select_query('usuarios', array('session_id'), array('id' => '='), array($id));
		return $this->_dbf->sql_get_num();
	}
}
