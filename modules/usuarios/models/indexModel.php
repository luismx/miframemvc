<?php
/**
 * Luis Perera
 */
class indexModel extends Model {

	function __construct() {
		parent::__construct();
	}

	public function getCampos($tabla) {
		$data   = array('TABLE' => $tabla, 'COLUMNS' => '*', 'WHERE' => 'id > 0 LIMIT 1');
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);
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
		return $this->_dbf->sql_get_columna($tabla, $columna, $id);
	}

	public function updateColumna($tabla, $columna, $valor, $id) {
		return $this->_dbf->sql_update_columna($tabla, $columna, $valor, $id);
	}

	public function getTipos() {
		return $this->_dbf->sql_get_select('tipos', 'nombre', 'id != 4');
	}
}
?>