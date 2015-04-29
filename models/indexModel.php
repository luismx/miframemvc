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
		return $this->_dbf->sql_get_assoc();

	}

	public function setDato($columna, $valor, $id) {
		$this->_dbf->select_query('usuarios',array($columna=>'='),array('id'=>'='),'',array($valor,$id));
		return $this->_dbf->sql_get_assoc();
	}
}
