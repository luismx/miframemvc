<?php
/**
 * @Dev Luis Perera
 */
class indexModel extends Model {

	function __construct() {
		parent::__construct();
	}

	public function getCampos($tabla) {
		$this->_dbf->select_query($tabla, array('*'), array('id' => '>'), 'LIMIT 1', array(0));
		$this->_dbf->sql_get_list();
	}

	public function getDatosUsuario($id) {
		$this->_dbf->select_query('usuarios', array('*'), array('id' => '='), '', array($id));
		return $this->_dbf->sql_get_list();

	}

	public function getUsuario($usuario, $tipo) {
		$this->_dbf->select_query('usuarios', array('id'), array('usuario' => '=', 'id_tipo' => '=', 'id' => '<>'), '', array($usuario, $tipo, Session::get('usuario', 'id')));
		return $this->_dbf->sql_get_list();
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
		$this->_dbf->insert_query($tabla, array($columna => '='), array('id'), '', array($valor, $id));
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