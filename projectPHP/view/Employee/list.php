<?php require "view/header.php";?>
	<a href="index.php?c=employee&a=edit"><button>New</button></a>
	<hr>
	<table class="tbData">
		<thead>
			<tr>
				<td>Id</td>
				<td>Name</td>
				<td>Age</td>
				<td></td>
			</tr>
		</thead>
		<tbody>
			<?php foreach ($emps as $e) {?>
				<tr>
					<td><?php echo $e->idEmployee;?></td>
					<td><?php echo $e->Name;?></td>
					<td><?php echo $e->Edad;?></td>
					<td>
						<a href="index.php?c=employee&a=edit&id=<?php echo $e->idEmployee;?>"><button>Edit</button></a> |
						<form action="index.php?c=employee&a=del" method="POST" 
							style="display:inline">
							<input type="hidden" name="id" value="<?php echo $e->idEmployee;?>">
							<input type="submit" name="send" value="Delete">
						</form>
					</td>
				</tr>				
			<?php }?>
		</tbody>
	</table>
<?php require "view/footer.php";?>