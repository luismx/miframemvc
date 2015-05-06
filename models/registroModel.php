<?php
class registroModel extends Model {
	public function __construct() {
		parent::__construct();
	}

	public function getTipos() {
		$this->_dbf->select_query('tipos',array('*'));
		$arr = $this->_dbf->sql_get_assoc();

		$string = "<option value='0'>Elige...</option>";
		if (count($arr) > 0) {
			foreach ($arr as $row) {
				if ($row['id'] != 4) 
					$string .= "<option value='".$row['id']."'>".$row['nombre']."</option>";
			}
		}

		return $string;
	}

	function guardar($arr, $values) {
		$insert = $this->_dbf->get_insert_query($arr);
		$q      = $this->_db->prepare($insert);
		$q->execute($values);
		return $this->_db->lastInsertId();
	}

	function buscar($arr) {
		$this->_dbf->select_query();
		/*$select = $this->_dbf->get_select_query($arr);
		$q      = $this->_db->query($select);
		return $q->fetch(PDO::FETCH_NUM);*/
	}

	function getUsuario($usuario) {
		$data   = array('TABLE' => 'usuarios', 'COLUMNS' => 'usuario', 'WHERE' => "nombre = '$usuario' AND id <> " .Session::get('usuario', 'id'));
		$select = $this->_dbf->get_select_query($data);
		$q      = $this->_db->query($select);
		if ($q) {
			return 1;
		} else {

			return 0;
		}
	}
}
?>