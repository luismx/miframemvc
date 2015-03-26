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
		var_dump($_SESSION);
		$this->_view->renderizar('index');
	}
}
?>