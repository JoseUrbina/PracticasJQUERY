<?php
	namespace Controller;

	require "Model/product.php";
	//require_once "Model/brand.php";

	use Model\product;
	use Model\brand;

	class ProductController
	{
		public $prod;

		public function index()
		{
			$prod = new product;
			$products = $prod->getAllProducts();
			require "View/product/list.php";
		}

		public function edit()
		{
			$product = new product;

			if(isset($_GET['id']))
			{
				$prod = new product;
				
				$idProduct = htmlentities(addslashes($_GET['id']));
				
				$product = $prod->findProduct($idProduct);

				if(!$product)
					header("location:index.php");
			}

			$brand = new brand;
			$brands = $brand->getAllBrands();

			require "View/product/edit.php";
		}

		public function save()
		{
			$product = new product;
			$product->idProduct = htmlentities(addslashes($_POST['idProduct']));
			$product->idBrand = $_POST['idBrand'];
			$product->name = htmlentities(addslashes($_POST['name']));
			$product->statu = 1;

			$response = $product->sORuProduct();

			if($response['status'])
			{
				echo "<script>alert(" . $response['message'] . ")</script>";
				header("location:index.php");
			}
			else
			{
				echo "<script>alert(" . $response['message'] . ")</script>";
			}
		}

		public function delete()
		{
			if(isset($_POST['id']))
			{
				$idProduct = htmlentities(addslashes($_POST['id']));
				$prod = new product;
				$response = $prod->deleteProduct($idProduct);

				if($response['status'])
				{
					echo "<script>alert(" . $response['message'] . ")</script>";
					header("location:index.php");
				}
				else
				{
					echo "<script>alert(" . $response['message'] . ")</script>";
				}
			}
		}
	}