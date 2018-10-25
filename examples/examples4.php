<?php
	class Articulo
	{
		public $idArt;
		public $name;

		public function getArticulo($id, $name)
		{
			$obj = new Articulo();
			$obj->idArt = $id;
			$obj->name = $name;

			$this = $obj;


			return $this;
		}
	}