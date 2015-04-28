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
		$select = "SELECT * FROM empresas WHERE id_usuario=:id_usuario LIMIT 1";
		$data   = array(':id_usuario' => Session::get('usuario', 'id'));
		$this->_dbf->q($select, $data);
		if ($this->_dbf->get_num_rows() > 0) {
			return $this->_dbf->sql_get_list();
		}
	}

	public function generarthEmpresas() {
		$select = "SELECT nombre,razon_social,rfc,contacto,email,status,id FROM empresas WHERE id_usuario = :id_usuario ORDER BY ORDER BY status,nombre ASC LIMIT 25";
		$data   = array('id_usuario' => Session::get('usuario', 'id'));
		$this->_dbf->q($select, $data);
		if ($this->_dbf->get_num_rows() > 0) {
			return $this->_dbf->sql_get_list();
		}
	}

	public function setStatus($id, $valor) {
		$update = "UPDATE empresas SET status = :status WHERE id = :id";
		$data   = array(':status' => $valor, ':id' => $id);
		$this->_dbf->q($update, $data);
		if ($this->_dbf->get_num_rows() > 0) {
			return true;
		}
	}

	public function getRfc($rfc) {
		$arrRfc = array();
		$select = "SELECT * FROM empresas WHERE rfc = :rfc AND id_padre = :id_padre";
		$data   = array(':rfc' => $rfc, ':id_padre' => 0);
		$this->_dbf->q($select, $data);
		if ($this->_dbf->get_num_rows() > 0) {
			foreach ($this->_dbf->sql_get_list() as $row) {

			}
		}
		/*$data   = array("TABLE" => 'empresas', 'COLUMNS' => '*', 'WHERE' => "rfc='$rfc' AND id_padre = 0");
		$select = $this->_dbf->get_select_query($data);*/
		$q = $this->_db->query($select);
		if ($q->fetchColumn() > 0) {
			foreach ($q as $row) {
				var_dump($row);
			}

			$data   = array("TABLE" => 'empresas', 'COLUMNS' => '*', 'WHERE' => "rfc='$rfc' AND id_padre > 0 ORDER BY nombre ASC");
			$select = $this->_dbf->get_select_query($data);
			$qu     = $this->_db->query($select);

			if ($qu->fetch() > 0) {
				foreach ($qu as $row) {
					return $row;
				}
			}
		}
	}
}
