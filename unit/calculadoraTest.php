<?php 
	include "calculadora.php";
	use PHPUnit\Framework\TestCase;

	class calculadoraTest extends TestCase
	{
		public function testSuma()
		{	
			$cal = new Calculadora();		
			$this->assertEquals(
				11,
				$cal->suma(4,7)
			);
		}

		public function multTest()
		{
			$cal = new Calculadora();
			$this->assertEquals(
				4, 
				$cal->mult(2,2)
			);
		}
	}

?>