<?php

/*
 * @Dev Luis Perera
 */

class indexController extends empresasController {
	private $_modelo;
	public function __construct() {
		parent::__construct();
		$this->_modelo            = $this->loadModel('index', 'empresas');
		$this->_view->numEmpresas = $this->_modelo->getNumEmpresas();
	}

	public function index() {
		$this->_view->empresas = $this->generarthEmpresas();
		$this->_view->renderizar('index');
	}

	public function nueva() {
		if (isset($_POST['guardar']) and $_POST['guardar'] == 1) {
			$this->guardar($_POST);
		}

		$this->_view->renderizar('nueva');
	}

	public function generarthEmpresas() {
		$empresas = $this->_modelo->generarthEmpresas();
		if (is_array($empresas) and count($empresas) > 0) {
			$i = 1;
			foreach ($empresas as $row) {
				if ($row[1] == 0) {
					$arr[] = "<tr class='danger'>
					<td>$i</td>
					<td>" .$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$row[6]."</td>
					<td><button type='button' class='btn btn-default activar' title='Activar' valor='".$row[0]."'><a class='glyphicon glyphicon-ok'></a></button></td></tr>";
				} else {
					$arr[] = "<tr><td>$i</td>
					<td>" .$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td>".$row[5]."</td>
					<td>".$row[6]."</td>
					<td><button type='button' class='btn btn-default desactivar' title='Desactivar' valor='".$row[0]."'><a class='glyphicon glyphicon-remove'></a></button></td></tr>";
				}
				$i++;
			}

			return $arr;
		}
	}

	public function getEmpresasValidas() {
		$empresas = $this->_modelo->generarthEmpresas();

		if (is_array($empresas) and count($empresas) > 0) {
			$i = 1;
			foreach ($empresas as $row) {
				if ($row[5] == 0) {
					$arr[] = "<tr class='danger'>
					<td>$i</td>
					<td>" .$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td><button type='button' class='btn btn-default activar' title='Activar' valor='".$row[6]."'><a class='glyphicon glyphicon-ok'></a></button></td></tr>";
				} else {
					$arr[] = "<tr>
					<td>$i</td>
					<td>" .$row[0]."</td>
					<td>".$row[1]."</td>
					<td>".$row[2]."</td>
					<td>".$row[3]."</td>
					<td>".$row[4]."</td>
					<td><button type='button' class='btn btn-default desactivar' title='Desactivar' valor='".$row[6]."'><a class='glyphicon glyphicon-remove'></a></button></td></tr>";
				}

				$i++;
			}

			return $arr;
		}
	}

	/**
	 * *
	 * ajax
	 * @return String realiza un ajax para activar/desactivar las empresas del usuario, buscar rfc
	 */

	public function getRfc() {
		if (isset($_POST['rfc'])) {
			$post   = $this->_funciones->quitarEspacios($_POST['rfc']);
			$valido = $this->_funciones->validarRfc($post);

			if ($valido) {
				$arreglo = array();
				$data    = $this->_modelo->getRfc($post, 0, array('rfc' => '=', 'id_padre' => '='));

				if (is_array($data) and count($data) > 0) {
					foreach ($data as $row) {
						$arreglo[] = $row;
						$data      = $this->_modelo->getRfc($post, $row['id'], array('rfc' => '=', 'id_padre' => '='));

						if (is_array($data) and count($data) > 0) {
							foreach ($data as $row) {
								$arreglo[] = $row;
							}
						}
					}
				}
				echo json_encode($arreglo);
			}
		}
	}

	public function guardar($post) {
		$errores = array();
		$this->_funciones->clean($post);

		$columnas = $this->_modelo->getColumnas('empresas');

		if (count($errores) > 0) {
			return $errores;
		}
	}

	public function editar() {
		if (isset($_POST['id'])) {
			echo "Empresa editada.";
		}
	}

	public function activar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			echo $this->_modelo->setStatus($id, 1);
		}
	}

	public function desactivar() {
		if (isset($_POST['id'])) {
			$id = $_POST['id'];
			echo $this->_modelo->setStatus($id, 0);
		}
	}

	public function buscarEmpresa($rfc) {
		$this->_funciones->validarRfc($rfc);
	}

	public function validarRfc() {
		if (isset($_POST['rfc'])) {
			$rfc    = $_POST['rfc'];
			$valido = $this->_funciones->validarRfc($rfc);
			if ($valido) {
				echo 1;
			} else {
				echo 0;
			}
		}
	}

	public function getMatriz() {
		if (isset($_POST['rfc'])) {
			$valido = $this->_funciones->validarRfc($_POST['rfc']);
			if ($valido) {
				$matriz = $this->_modelo->getEmpresa(array('rfc' => '=', 'id_padre' => '='), array($_POST['rfc'], 0));
				echo json_encode($matriz);
			}
		}
	}

	public function getSucursales() {
		if (isset($_POST['rfc']) and isset($_POST['id'])) {
			$id       = $_POST['id'];
			$sucursal = $this->_modelo->getEmpresa(array('rfc' => '=', 'id_padre' => '='), array($_POST['rfc'], $id));
			echo json_encode($sucursal);
		}
	}
}
