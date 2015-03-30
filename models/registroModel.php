<?php
class registroModel extends Model{
    public function __construct() {
        parent::__construct();
    }

    public function getTipos(){
        $data = array('TABLE'=>'tipos','COLUMNS'=>'*');
    	$select = $this->_dbf->get_select_query($data);
        $q = $this->_db->query($select);
        $string = "<option value='0'>Elige...</option>";
        
        if(count($q->fetch(PDO::FETCH_ASSOC)) > 0){
            foreach ($q as $row){
                $string .= "<option value='".$row['id']."'>".$row['nombre']."</option>";
            }
        }
        
        return $string;
    }
    
    function guardar($arr,$values){
        $insert = $this->_dbf->get_insert_query($arr);
        $q = $this->_db->prepare($insert);
        $q->execute($values);
        return $this->_db->lastInsertId();
    }
    
    function buscar($arr){
        $select = $this->_dbf->get_select_query($arr);
        $q = $this->_db->query($select);
        return $q->fetch(PDO::FETCH_NUM);
    }
}
?>