<?php

/*
 * @Dev Luis Perera
 */
class indexModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getDatosUsuario($select, $data) {
		$q = $this->_dbf->q($select, $data);
		if ($this->_dbf->get_num_rows > 0) {
			return sql_get_list();
		}
		$select = $this->_dbf->get_select_query($arr);
		$q      = $this->_db->query($select);
		return $q->fetch(PDO::FETCH_ASSOC);
	}

	public function setDato($columna, $valor, $id) {
		$update = "UPDATE usuarios SET $columna = :valor WHERE id = :id";
		$data   = array(':valor' => $valor, ':id' => $id);
		return $this->_dbf->q($update, $data);

		/*
	$data = array('TABLE'=>'usuarios','COLUMNS'=>"$columna = '$valor'", 'WHERE'=>"id = $id");
	$update = $this->_dbf->get_update_query($data);
	return $q = $this->_db->query($update);
	 */

	}
}
