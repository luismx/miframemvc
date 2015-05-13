<?php
require ('../modules/empresas/controllers/indexController.php');
class empresasIndexControllerTest extends PHPUnit_Framework_TestCase {
	public function testCanBeArray() {
		$a = new indexController();

		$b = $a->generarthEmpresas();
		$this->assertEquals(0, count($b));
	}
}
?>
