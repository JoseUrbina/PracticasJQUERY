<?php include "View/header.php"; ?>
	<a href="?c=product&a=edit"><button>New</button></a>
	<hr>
	<table>
		<thead>
			<tr>
				<td>ID</td>
				<td>Product</td>
				<td>Brand</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach($products as $prod){ ?>
				<tr>
					<td><?php echo $prod->idProduct;?></td>
					<td><?php echo $prod->name;?></td>
					<td><?php echo $prod->brand->brandName;?></td>
					<td>
						<a href="?c=product&a=edit&id=<?php echo $prod->idProduct;?>">
							<button>Edit</button></a>
						<form id="frmDelete" method="POST" action="?c=product&a=delete">
							<input type="hidden" name="id" 
								   value="<?php echo $prod->idProduct;?>">
							<input type="submit" value="Delete">
						</form>						
					</td>
				</tr>
			<?php }	?>
		</tbody>
	</table>

<?php include "View/footer.php"; ?>