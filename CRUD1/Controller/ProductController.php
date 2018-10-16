<?php 
	require_once 'Model/productoModel.php';

	class ProductController
	{
		private $product;

		function __construct()
		{
			try
			{
				$this->product = new productoModel();
			}
			catch(Exception $e)
			{
				die("Error: {$e->getMessage()}");
			}
		}

		public function index()
		{
			$numPag = 4;

			if(isset($_GET['pag']))
			{
				$pagina = $_GET['pag'];
			}
			else
			{
				$pagina = 1;
			}

			$numRows = $this->product->numRecords();

			$totalPaginas = ceil($numRows['total']/$numPag);

			$products = $this->product->getProducts($pagina, $numPag, $totalPaginas);
			require_once 'View/Producto/list.php';
		}

		public function add()
		{
			$Product = new productoModel();
			require_once 'View/Producto/edit.php';
		}

		public function save()
		{
			$nameImage = $_FILES['FOTO']['name'];
			$typeImage = $_FILES['FOTO']['type'];
			$sizeImage = $_FILES['FOTO']['size'];

			/*
				image/jpg, image/jpeg, image/gif, image/png
			*/
		
			$carpeta_destino = "Imagenes/";

			move_uploaded_file($_FILES['FOTO']['tmp_name'], $carpeta_destino . $nameImage);

			$Product = new productoModel();
			$Product->ID = htmlentities(addslashes($_POST['ID']));
			$Product->SECCION = htmlentities(addslashes($_POST['SECCION']));
			$Product->NOMBRE = htmlentities(addslashes($_POST['NOMBRE']));
			$Product->FOTO = $nameImage;

			if($this->product->addOrEditProduct($Product))
			{
				header('location:index.php');
			}
		}

		public function edit()
		{
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];

				$Product = $product->findProduct($id);
				require_once 'View/Producto/edit.php';
			}
			else
			{
				header('location:index.php');
			}
		}

		public function del()
		{
			if(isset($_GET['id']))
			{
				$id = $_GET['id'];

				if($this->product->deleteProduct($id))
				{
					header('location:index.php');
				}
			}
			else
			{
				header('location:index.php');
			}
		}
	}
?>