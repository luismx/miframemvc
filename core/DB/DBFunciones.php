<?php
include_once 'Conexion.php';

class DBFunciones {
	private $_conn;
	private $_stmt;
	private $_numRows;
	private $_error;
	private $_affectedRows;

	private function q($consulta, $valores = array()) {
		$this->_conn = new Conexion();
		$this->_stmt = $this->_conn->prepare($consulta);
		$this->_stmt->execute($valores);
		$this->check_query();
		$this->_conn = NULL;
	}

	public function get_num_rows() {
		$i = 0;
		while ($this->_stmt->fetch(PDO::FETCH_NUM)) {
			$i++;
		}

		return $i;
	}

	public function get_affected_rows() {
		return $this->_affectedRows;
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
			if (count($this->_error[1]) > 0) {
				var_dump($this->get_error());
			}
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
	public function sql_get_assoc() {
		$arr = array();
		while ($row = $this->_stmt->fetch(PDO::FETCH_ASSOC)) {
			$arr[] = $row;
		}

		return $arr;
	}

	public function sql_get_num() {
		$arr = array();
		while ($row = $this->_stmt->fetch(PDO::FETCH_NUM)) {
			$arr[] = $row;
		}

		return $arr;
	}

	public function select_query($tabla, $columna = array(), $where = array(), $data = array(), $inners = false, $extra = false) {
		$arr    = array();
		$select = "SELECT ";

		for ($i = 0; $i < count($columna); $i++) {
			if ($i == 0) {
				$select .= $columna[$i];
			} else {
				$select .= ", ".$columna[$i];
			}
		}
		$select .= " FROM $tabla $inners";

		if (count($where) > 0) {
			$select .= " WHERE ";
			$i = 0;
			foreach ($where as $key => $value) {
				if ($i == 0) {
					$select .= "$key $value :$key";
				} else {
					$select .= " AND $key $value :$key";
				}

				$arr[":".$key] = $data[$i];

				$i++;
			}
		}
		$select .= " $extra";

		$this->q($select, $arr);
	}

	public function update_query($tabla, $columna = array(), $where = array(), $extra = null, $data = array()) {
		$arr    = array();
		$update = "UPDATE $tabla SET ";
		$i      = 0;
		foreach ($columna as $key => $value) {
			if ($i == 0) {
				$update .= "$key $value :$key";
			} else {
				$update .= ", $key $value :$key";
			}

			$arr[":".$key] = $data[$i];
			$i++;
		}

		$update .= " WHERE ";
		$j = 0;
		foreach ($where as $key => $value) {
			if ($j == 0) {
				$update .= "$key $value :$key";
			} else {
				$update .= ", $key $value :$key";
			}

			$arr[":".$key] = $data[$i];
			$j++;
			$i++;
		}

		$update .= " $extra";
		$this->q($update, $arr);
		$this->_affectedRows = $this->_stmt->rowCount();
	}

	public function insert_query($tabla, $columna = array()) {
		$insert = "INSERT INTO $tabla (";
		$i      = 0;
		$val    = " VALUES(";
		$arr    = array();
		foreach ($columna as $key => $value) {
			if ($i == 0) {
				$insert .= "$key";
				$val .= ":$key";
			} else {
				$insert .= ", $key";
				$val .= ",:$key";
			}

			$arr[':'.$key] = $value;
			$i++;
		}
		$value .= ")";
		$insert .= ") $value";
		$this->q($insert, $arr);

		$this->_affectedRows = $this->_stmt->rowCount();
	}
	public function delete_query($tabla, $columna, $val) {
		$delete = "DELETE FROM $tabla WHERE $columna = :$columna";
		$data   = array(":$columna"=> $val);
		$this->q($delete, $data);
		$this->_affectedRows = $this->_stmt->rowCount();
	}
}
?>