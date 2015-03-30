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

	public function getDatosUsuario($id){
		$data = array('TABLE' => 'usuarios', 'COLUMNS'=>'*', 'WHERE'=>'id = '.$id);
		$select = $this->_dbf->get_select_query($data);
		$q = $this->_db->query($select);
		if ($q) {
			foreach ($q->fetch(PDO::FETCH_ASSOC) as $llave => $valor) {
				$datos[$llave] = $valor;
			}
			return $datos;
		}
	}


	public function getTipos(){
        $data = array('TABLE'=>'tipos','COLUMNS'=>'*');
    	$select = $this->_dbf->get_select_query($data);
        $q = $this->_db->query($select);
        $string = "<option value='0'>Elige...</option>";
        
        if(count($q->fetch(PDO::FETCH_ASSOC)) > 0){
            foreach ($q as $row){
            	if ($row['id'] == Session::get('usuario','id_tipo')) 
                	$string .= "<option value='".$row['id']."' selected='selected'>".$row['nombre']."</option>";
                else
                	$string .= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
        }
        
        return $string;
    }

    public function updateColumna($tabla, $columna,$valor,$id){
        $data = array('TABLE' =>$tabla,'COLUMNS'=>"$columna = '$valor'",'WHERE'=>"id = $id");
        $update = $this->_dbf->get_update_query($data);
        $q = $this->_db->query($update);
        return $q;
    }

    public function updateSession($id){
    	$datos = $this->getDatosUsuario($id);
    	if ($datos) {
    		foreach ($datos as $key => $value) {
    			if ($key != 'clave') 
    				$_SESSION['usuario'][$key] = $value;
    		}
    	}
    }
   
}
?>