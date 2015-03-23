<?php
class View{
    private $_r;
    
    public function __construct(Request $r) {
        parent::__construct();
        $this->_r = $r;
    }
}
?>

