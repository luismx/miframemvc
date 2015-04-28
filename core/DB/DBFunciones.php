<?php
include_once 'Conexion.php';

class DBFunciones {
	private $_conn;
	private $_stmt;
	private $_numRows;
	private $_error;

	function __construct() {
		$this->_conn = new Conexion();
	}

	public function q($consulta, $valores = array()) {
		$this->_stmt = $this->_conn->prepare($consulta);
		$this->_stmt->execute($valores);
		$this->check_query();
	}

	public function get_num_rows() {
		return $this->_stmt->fetchColumn();
	}

	/**
	 * Funciones GET
	 * @param  [type] $p [description]
	 * @return [type]    [description]
	 */

	public function get_insert_id() {
		return $this->_conn->lastInsertId();
	}

	private function check_query() {
		$this->_error = $this->_stmt->errorInfo();

		if (!PRODUCTION) {
			$this->get_error();
		}
	}

	public function get_error() {
		$e         = array();
		$e['ref']  = $this->_error[0];
		$e['code'] = $this->_error[1];
		$e['desc'] = $this->_error[2];

		return $e;
	}

	/**
	 * Funciones SQL
	 */
	public function sql_get_list() {
		$arr = array();
		while ($row = $this->_stmt->fetch(PDO::FETCH_ASSOC)) {
			$arr[] = $row;
		}

		return $arr;
	}

	/*public static function get_json_query() {
	return json_encode($this->sql_rows());
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
	}*/

	/*
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


public function sql_get_menu($idTipo) {
$arreglo = array();
$select  = "SELECT * FROM menu WHERE id_tipo <= $idTipo ORDER BY id_tipo";
if ($q) {
foreach ($q->fetchAll(PDO::FETCH_ASSOC) as $row) {

}
}
}*/
}
?>