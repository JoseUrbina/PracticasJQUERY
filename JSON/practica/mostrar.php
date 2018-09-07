<?php 
	header('Content-Type:application/json');

class Cancion
{
	public $titulo;
	public $autor;
	public $album;
}

$canciones = array();

$cancion1 = new Cancion();
$cancion1->titulo = 'Shooting stars';
$cancion1->autor = 'Unknown';
$cancion1->album = 'Roses';
$canciones[] = $cancion1;

$cancion2 = new Cancion();
$cancion2->titulo = 'Gata Salvaje';
$cancion2->autor = 'Unknown';
$cancion2->album = 'Spring';
$canciones[] = $cancion2;

$cancion3 = new Cancion();
$cancion3->titulo = 'Blame';
$cancion3->autor = 'Unknown';
$cancion3->album = 'Calvin Harris';
$canciones[] = $cancion3;

echo json_encode($canciones, JSON_OBJECT_AS_ARRAY);
?>