<?php

/**
 * @author Luis Antonio Perera <luanup.pro@gmail.com>
 */

class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getColumnas($tabla) {
		$this->_dbf->create_query('DESCRIBE '.$tabla);
		return $this->_dbf->sql_get_assoc();
	}

	public function getNumEmpresas() {
		$this->_dbf->select_query('empresas', array('*'), array('id_usuario' => '='), array(Session::get('usuario', 'id')), '', 'LIMIT 1');
		return $this->_dbf->sql_get_assoc();
	}

	public function generarthEmpresas() {
		$arreglo = array();
		$this->_dbf->select_query('usuarios_empresas', array('id_empresa,status'), array('id_usuario' => '=', 'status' => '>='), array(Session::get('usuario', 'id'), 0));
		$id = $this->_dbf->sql_get_assoc();
		foreach ($id as $key => $value) {

			$this->_dbf->select_query('empresas', array('nombre', 'razon_social', 'rfc', 'contacto', 'email', 'status', 'id'), array('id' => '=', 'status' => '='), array($value['id_empresa'], 1), '', 'ORDER BY status,nombre ASC');
			$arr = $this->_dbf->sql_get_num();
			if (count($arr) > 0) {
				foreach ($arr as $llave => $valor) {
					$arreglo[$value['status']] = $valor;
				}
			}
		}

		return $arreglo;
	}

	public function setStatus($id, $valor) {
		$this->_dbf->update_query('usuarios_empresas', array('status' => '='), array('id' => '='), '', array($valor, $id));
		return $this->_dbf->get_affected_rows();
	}

	public function getRfc($rfc, $valor, $where) {
		$this->_dbf->select_query('empresas', array('id', 'rfc', 'razon_social', 'id_padre'), $where, array($rfc, $valor), '', '');
		return $this->_dbf->sql_get_assoc();
	}

	public function getEmpresa($id) {
		$this->_dbf->select_query('empresas', array('*'), array('id' => '='), array($id), '', '');
		return $this->_dbf->sql_get_assoc();
	}
}
