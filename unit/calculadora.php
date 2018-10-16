<?php
	class Calculadora
	{
		public function __construct()
		{
			echo "Calculadora númerica";
		}

		public function suma($a, $b)
		{
			return $a + $b;
		}

		public function mult($a, $b)
		{
			return $a * $b;
		}
	}