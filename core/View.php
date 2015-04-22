<?php
class View {
	private $_controlador;
	private $_js;
	private $_req;
	private $_rutas;
	private $_template;

	public function __construct(Request $r) {
		$this->_req         = $r;
		$this->_controlador = $r->getControlador();
		$this->_js          = array();
		$this->_rutas       = array();
		$this->_template    = STATIC_DIR;

		$modulo      = $this->_req->getModulo();
		$controlador = $this->_req->getControlador();
		if ($modulo) {
			$this->_rutas['header'] = ROOT.'modules'.DS.'views'.DS.'default'.DS.'header.html';
			$this->_rutas['view']   = ROOT.'modules'.DS.$modulo.DS.'views'.DS.$controlador.DS.'html'.DS;
			$this->_rutas['footer'] = ROOT.'modules'.DS.'views'.DS.'default'.DS.'footer.html';
			$this->_rutas['js']     = 'modules/'.$modulo.'/views/'.$controlador.'/js/';
		} else {
			$this->_rutas['header'] = ROOT.'views'.DS.'default'.DS.'header.html';
			$this->_rutas['view']   = ROOT.'views'.DS.$controlador.DS.'html'.DS;
			$this->_rutas['footer'] = ROOT.'views'.DS.'default'.DS.'footer.html';
			$this->_rutas['js']     = 'views/'.$controlador.'/js/';
		}

		$this->_js = $this->_rutas['js'];
	}

	public function renderizar($vista, $item = false) {
		$_layoutArr = array(
			'theme_css' => DEFAULT_THEME.'css/',
			'theme_js'  => DEFAULT_THEME.'js/',
			'img'       => BASE_URL.'views/'.$this->_controlador.'/img/',
		);

		if (is_readable($this->_rutas['view'].$vista.'.html')) {
			if ($this->_controlador == "error") {
				include_once $this->_rutas['view'].$vista.'.html';
			} else {
				include_once $this->_rutas['header'];
				include_once $this->_rutas['view'].$vista.'.html';
				include_once $this->_rutas['footer'];
			}
		} else {
			header('location:'.BASE_URL.'error/_404');
		}

	}
}
?>

