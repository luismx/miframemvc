<?php

/**
 * @author Luis Antonio Perera <luanup.pro@gmail.com>
 */

class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getColumnas($tabla) {
		return $this->_dbf->sql_get_nombreColumnas($tabla);
	}

	public function getNumEmpresas() {
		$this->_dbf->select_query('empresas', array('*'), array('id_usuario' => '='), array(Session::get('usuario', 'id')),'','LIMIT 1');
		return $this->_dbf->sql_get_assoc();
	}

	public function generarthEmpresas() {
		/*$this->_dbf->select_query('usuarios_empresas',array('id_usuario','id_empresa','status'),array('id_usuario'=>'='));*/
		$this->_dbf->select_query('empresas', array('nombre', 'razon_social', 'rfc', 'contacto', 'email', 'status', 'id'), array('id_usuario' => '='), 'ORDER BY status,nombre ASC LIMIT 25', array(Session::get('usuario', 'id')));
		return $this->_dbf->sql_get_num();
	}

	public function setStatus($id, $valor) {
		$this->_dbf->update_query('empresas', array('status' => '='), array('id' => '='), '', array($valor, $id));
		return $this->_dbf->get_affected_rows();
	}

	public function getRfc($rfc,$valor,$where) {
		$arrRfc = array();
		$this->_dbf->select_query('empresas',array('id','rfc','razon_social','id_padre'),$where,array($rfc,$valor));
		return $this->_dbf->sql_get_assoc();
	}
	
	public function getEmpresa($id){
		$this->_dbf->select_query('empresas',array('*'),array('id'=>'='),array($id),'');
		return $this->_dbf->sql_get_assoc();
	}
}
