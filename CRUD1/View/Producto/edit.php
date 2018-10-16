<?php require 'View/header.php'; ?>

<form method="POST" action="?c=product&a=save" enctype="multipart/form-data">
	<input type="hidden" name="ID" value="<?php echo ($Product->ID > 0)?$Product->ID:0;?>">
	<label>
		Seccion: <input type="text" name="SECCION" value="<?php echo $Product->SECCION;?>">
	</label><br><br>
	<label>
		Nombre: <input type="text" name="NOMBRE" value="<?php echo $Product->NOMBRE;?>">
	</label><br><br>
	<label>
		Foto: <input type="file" name="FOTO">
	</label><br><br>
	<input type="submit" name="Save" value="Save">
</form>

<?php require 'View/footer.php'; ?>