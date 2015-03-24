<?php
/**
* Luis Perera
*/
class indexController extends usuariosController
{
	
	function __construct()
	{
		parent::__construct();
	}

	public function index(){
		$this->_view->renderizar('index');
	}
}
?>