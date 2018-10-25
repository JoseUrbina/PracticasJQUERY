<?php 
	namespace examples;

	include "example1.php";

	class second
	{
		public function execMessage($mess)
		{
			first::showMessage($mess);
		}
	}