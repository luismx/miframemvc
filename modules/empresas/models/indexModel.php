<?php

/*
 * @Dev Luis Perera
 */

class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getColumnas($tabla) {
		return $this->_dbf->sql_get_nombreColumnas($tabla);
	}

	public function getNumEmpresas() {
		$data   = array('TABLE' => 'empresas', 'COLUMNS' => '*', 'WHERE' => 'id_usuario = '.Session::get('usuario', 'id').' LIMIT 1');
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);
		if ($q) {
			return $q->fetch(PDO::FETCH_NUM);
		}
	}

	public function generarthEmpresas() {
		$data   = array('TABLE' => 'empresas', 'COLUMNS' => 'nombre,razon_social,rfc,contacto,email,status,id', 'WHERE' => 'id_usuario = '.Session::get('usuario', 'id').' ORDER BY nombre, status ASC LIMIT 25');
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);
		if ($q) {
			return $q->fetchAll(PDO::FETCH_NUM);
		}
	}

	public function setStatus($id, $valor) {
		return $update = $this->_dbf->sql_update_columna('empresas', 'status', $valor, $id);
	}

	public function getMatriz() {

	}
}
