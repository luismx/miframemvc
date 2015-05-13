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
		$this->_dbf->select_query('usuarios_empresas', array('id', 'id_empresa,status'), array('id_usuario' => '=', 'status' => '>='), array(Session::get('usuario', 'id'), 0));
		$id = $this->_dbf->sql_get_assoc();
		foreach ($id as $key => $value) {

			$this->_dbf->select_query('empresas', array('nombre', 'razon_social', 'rfc', 'contacto', 'email'), array('id' => '=', 'status' => '='), array($value['id_empresa'], 1), '', 'ORDER BY status,nombre ASC');
			$arr = $this->_dbf->sql_get_num();

			if (count($arr) > 0) {
				foreach ($arr as $llave => $valor) {
					$arreglo[] = array($value['id'], $value['status'], $valor[0], $valor[1], $valor[2], $valor[3], $valor[4]);
				}
			}
		}
		return $arreglo;
	}

	public function setStatus($id, $valor) {
		$this->_dbf->update_query('usuarios_empresas', array('status' => '='), array('id' => '='), '', array($valor, $id));
		return $this->_dbf->get_affected_rows();
	}

	public function getEmpresa($where, $valores) {
		$this->_dbf->select_query('empresas', array('*'), $where, $valores);
		return $this->_dbf->sql_get_assoc();
	}
}
