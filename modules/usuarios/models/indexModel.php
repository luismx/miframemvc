<?php
/**
* Luis Perera
*/
class indexModel extends Model
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function getCampos($tabla){
		$data = array('TABLE' =>$tabla,'COLUMNS'=>'*','WHERE'=>'id > 0 LIMIT 1');
		$select = $this->_dbf->get_select_query($data);
		$q = $this->_db->query($select);
		return $q->fetch(PDO::FETCH_ASSOC);
	}

	public function updateColumna($columna,$valor,$id){
		$data = array('TABLE' =>'usuarios','COLUMNS'=>"$columna = ?",'WHERE'=>'id = '.Session:: );
	}

	public function getDatosUsuario($id){
		$data = array('TABLE' => 'usuarios', 'COLUMNS'=>'*', 'WHERE'=>'id = '.$id);
		$select = $this->_dbf->get_select_query($data);
		$q = $this->_db->query($select);
		return $q->fetch(PDO::FETCH_ASSOC);
	}
}
?>