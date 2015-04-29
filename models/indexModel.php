<?php

/*
 * @Dev Luis Perera
 */
class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getDatosUsuario($select, $data) {
		$this->_dbf->q($select, $data);
		return $this->_dbf->sql_get_list();

	}

	public function setDato($columna, $valor, $id) {
		$update = "UPDATE usuarios SET $columna = :valor WHERE id = :id";
		$data   = array(':valor' => $valor, ':id' => $id);
		//$this->_dbf->q($update, $data);
		$this->_dbf->q($update, $data);
		return true;
		//return $this->_dbf->sql_get_list();
		/*if (count($error) == 0) {*/

	}
}
