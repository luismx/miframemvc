<?php
include_once 'Conexion.php';

class DBFunciones {
	private $_conn;
	function __construct() {
		$this->_conn = new Conexion();
	}

	public static function get_insert_query($p) {
		$data = array($p['TABLE'], $p['COLUMNS'], $p['VALUES']);
		return vsprintf("INSERT INTO %s (%s) VALUES (%s)", $data);
	}

	public static function get_update_query($p) {
		$data = array($p['TABLE'], $p['COLUMNS'], $p['WHERE']);
		return vsprintf("UPDATE %s SET %s WHERE %s", $data);
	}

	public static function get_select_query($p) {
		if (!isset($p['WHERE'])) {
			$data = array($p['COLUMNS'], $p['TABLE']);
			return vsprintf("SELECT %s FROM %s", $data);
		} else {
			$data = array($p['COLUMNS'], $p['TABLE'], $p['WHERE']);
			return vsprintf("SELECT %s FROM %s WHERE %s", $data);
		}
	}

	public static function get_delete_query($p) {
		$data = array($p->table, $p->property_id);
		return vsprintf("DELETE FROM %s WHERE %s = ?", $data);
	}

	public static function get_composer_query($p, $compuesto) {
		$data = array($p->property_id, $p->table, $compuesto);
		return vsprintf("SELECT %s FROM %s WHERE %s = ?", $data);
	}

	public function sql_get_columna($tabla, $columna, $id) {
		$data   = array('TABLE' => $tabla, 'COLUMNS' => $columna, 'WHERE' => "id = $id");
		$select = self::get_select_query($data);
		$q      = $this->_conn->query($select);
		if ($q) {
			return $q->fetch(PDO::FETCH_ASSOC);
		}
	}

	public function sql_update_columna($tabla, $columna, $valor, $id) {
		$data   = array('TABLE' => $tabla, 'COLUMNS' => "$columna = '$valor'", 'WHERE' => "id = $id");
		$update = self::get_update_query($data);
		$q      = $this->_conn->query($update);
		return $q;
	}

	public function sql_get_nombreColumnas($tabla) {
		$select = "SELECT COLUMN_NAME FROM INFORMATION_SCHEMA.COLUMNS WHERE table_name = '$tabla'";
		$q      = $this->_conn->query($select);
		$q->fetch(PDO::FETCH_ASSOC);
		if ($q) {
			foreach ($q as $key => $value) {
				foreach ($value as $llave)
				$columna[] = $llave;
			}
			return array_unique($columna);
		}
	}

	public function sql_get_select($tabla, $columna, $where = false, $limit = false) {
		$option = "<option value=''>Elige...</option>";
		if ($where) {
			$where = " WHERE $where";
		}

		if ($limit) {
			$limit = " LIMIT $limit";
		}

		$select = "SELECT id, $columna FROM $tabla $where ORDER BY $columna ASC $limit";
		$q      = $this->_conn->query($select);
		if ($q) {
			while ($row = $q->fetch(PDO::FETCH_ASSOC)) {
				$option .= "<option value='".$row['id']."'>".$row[$columna]."</option>";
			}

			return $option;
		}

	}
}
?>