<?php include "View/header.php" ?> 
<form action="?c=product&a=save" method="POST">
	<input type="hidden" name="idProduct" 
		   value="<?php echo (isset($product->idProduct)?$product->idProduct:0);?>">
	<label>
		Product: <input type="text" name="name" value="<?php echo $product->name;?>">
	</label><br><br>
	<label>
		Brand: <select name="idBrand">
			<?php foreach($brands as $b){?>
				<option value="<?php echo $b->idBrand;?>" 
						<?php echo ($b->idBrand == $product->idBrand)?'selected':'';?>>
					<?php echo $b->brandName;?>
				</option>
			<?php }?>
		</select>
	</label><br><br>
	<input type="submit" name="save" value="Save">
</form>
<?php include "View/footer.php" ?>