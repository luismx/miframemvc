<?php
/**
 * @Dev Luis Perera
 */
class indexModel extends Model {

	function __construct() {
		parent::__construct();
	}

	public function getCampos($tabla) {
		$select = "SELECT FROM $tabla WHERE WHERE id > 0 LIMIT 1";
		$data   = array();
		$q      = $this->_dbf->q($select, $data);
		/*$data   = array('TABLE' => $tabla, 'COLUMNS' => '*', 'WHERE' => 'id > 0 LIMIT 1');
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);*/
		return $q->fetch(PDO::FETCH_ASSOC);
	}

	public function getDatosUsuario($id) {
		$data   = array('TABLE' => 'usuarios', 'COLUMNS' => '*', 'WHERE' => 'id = '.$id);
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);
		if ($q) {
			foreach ($q->fetch(PDO::FETCH_ASSOC) as $llave => $valor) {
				$datos[$llave] = $valor;
			}
			return $datos;
		}
	}

	public function getUsuario($usuario, $tipo) {
		$data          = array('TABLE' => 'usuarios', 'COLUMNS' => 'id', 'WHERE' => "usuario = '$usuario' AND id_tipo = '$tipo' AND id <> " .Session::get('usuario', 'id'));
		$select        = $this->_dbf->get_select_query($data);
		$q             = $this->_db->query($select);
		return $result = $q->fetch(PDO::FETCH_ASSOC);

	}

	public function updateSession($id) {
		$datos = $this->getDatosUsuario($id);
		if ($datos) {
			foreach ($datos as $key => $value) {
				if ($key != 'clave') {
					$_SESSION['usuario'][$key] = $value;
				}
			}
		}
	}

	public function getColumna($tabla, $columna, $id) {
		//return $this->_dbf->sql_get_columna($tabla, $columna, $id);

		$select = "SELECT $columna FROM $tabla WHERE id = :id";
		$data   = array(':id' => $id);
		$this->_dbf->q($select, $data);
		return $this->_dbf->sql_get_list();
	}

	public function updateColumna($tabla, $columna, $valor, $id) {
		$select = "UPDATE $tabla SET $columna = :valor WHERE id = :id";
		$data   = array(':valor' => $valor, ':id' => $id);
		$this->_dbf->q($select, $data);
		return $this->_dbf->sql_get_list();
	}

	public function getTipos() {
		//return $this->_dbf->sql_get_select('tipos', 'nombre', 'id != 4');
		$select = "SELECT id, nombre FROM tipos WHERE id =! :id";
		$data   = array(':id' => 4);
		$this->_dbf->q($select, $data);
		return $this->_dbf->sql_get_list();

	}
}
?>