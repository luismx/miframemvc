<?php
/**
 * @Dev Luis Perera
 */
class indexModel extends Model {

	function __construct() {
		parent::__construct();
	}

	public function getCampos($tabla) {
		$this->_dbf->select_query($tabla, array('*'), array('id' => '>'), array(0),'LIMIT 1');
		return $this->_dbf->sql_get_assoc();
	}

	public function getDatosUsuario($id) {
		$this->_dbf->select_query('usuarios', array('*'), array('id' => '='),array($id));
		return $this->_dbf->sql_get_assoc();

	}

	public function getUsuario($usuario, $tipo) {
		$this->_dbf->select_query('usuarios', array('id'), array('usuario' => '=', 'id_tipo' => '=', 'id' => '<>'), array($usuario, $tipo, Session::get('usuario', 'id')));
		return $this->_dbf->sql_get_assoc();
	}

	public function updateSession($id) {
		$arreglo = $this->getDatosUsuario($id);
		$datos   = array_pop($arreglo);

		if ($datos) {
			foreach ($datos as $key => $value) {
				if ($key != 'clave') {
					$_SESSION['usuario'][$key] = $value;
				}
			}
		}
	}

	public function getColumna($tabla, $columna, $id) {
		$this->_dbf->select_query($tabla, array($columna), array('id' => '='), array($id));
		return $this->_dbf->sql_get_assoc();
	}

	public function updateColumna($tabla, $columna, $valor, $id) {
		$this->_dbf->update_query($tabla, array($columna => '='), array('id' => '='), '', array($valor, $id));
		return $this->_dbf->get_affected_rows();
	}

	public function getTipos() {
		$this->_dbf->select_query('tipos', array('id', 'nombre'), array('id' => '!='), array(4));
		return $this->_dbf->sql_get_assoc();
	}
}
?>