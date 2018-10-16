<?php require 'View/header.php';?>
<a href="?c=product&a=add"><button>New</button></a>
<hr>
<table>
	<thead>
		<tr>
			<td width="80px">ID</td>
			<td>Seccion</td>
			<td>Nombre</td>
			<td>Image</td>
			<td width="160px">Action</td>
		</tr>
	</thead>
	<tbody>
		<?php foreach($products as $prod){?>
			<tr>
				<td><?php echo $prod->ID;?></td>
				<td><?php echo $prod->SECCION;?></td>
				<td><?php echo $prod->NOMBRE;?></td>
				<td><?php echo $prod->FOTO?></td>
				<td>
					<a href="?c=product&a=edit&id=<?php echo $prod->ID;?>"><button>Edit</button></a>
					<a href="?c=product&a=del&id=<?php echo $prod->ID;?>"><button>Delete</button></a>
				</td>
			</tr>
		<?php } ?>

		<tr>
			<td colspan="5">
				<?php
					$paginas = '';

					for($i=1;$i<=$totalPaginas;$i++)
					{
						$paginas .= "<a href='?pag={$i}'>{$i}</a> ";
					}

					echo $paginas;
				?>
			</td>
		</tr>
	</tbody>
</table>
<?php require 'View/footer.php';?>