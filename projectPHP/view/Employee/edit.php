<?php require "view/header.php";?>
	<form action="index.php?c=employee&a=save" method="POST">
		<input type="hidden" name="id" 
			   value="<?php echo ($sEmp->idEmployee > 0 ? $sEmp->idEmployee : 0); ?>">
		<label>
			Name: <input type="text" name="Name" value="<?php echo $sEmp->Name;?>">
		</label><br><br>
		<label>
			Age: <input type="number" name="Edad" min="0" max="100" value="<?php echo $sEmp->Edad;?>">
		</label><br><br>
		<label>Area: 
		<select name="idArea">
			<?php
				$find = false;

				foreach ($Areas as $Area) {
					if($sEmp->idArea > 0 && !$find)
					{
						echo "<option value=" . $Area->idArea . " selected>" . $Area->nArea . "</option>";
						$find = true;
					}
					else
					{
						echo "<option value=" . $Area->idArea . ">" . $Area->nArea . "</option>";
					}
				}
			?>
		</select>
		</label><br><br>
		<div>
			<label>Telefono: <input type="text" name="tel" id="tel"></label> | <button id="btnAdd">Add</button>
		</div>

		<div>
			<table id="tTabla">
				<thead>
					<tr>
						<td>Telefono</td>
						<td width="200px"></td>
					</tr>
				</thead>
				<tbody id="bodyTable">
					<?php
						if(count($sEmp->telefonos))
						{
							foreach ($sEmp->telefonos as $tel) {
					?>
						<tr>
							<td><?php echo $tel;?></td>
							<td>
								<button class="btnDel">Delete</button>
								<input type="hidden" value="<?php echo $tel;?>" name="Telefonos[]">
							</td>
						</tr>
					<?php }
						}
					?>
				</tbody>
			</table>
		</div>
		<hr>

		<input type="submit" name="save" value="save">
	</form>

	<script>
		document.getElementById('btnAdd').addEventListener('click', function(event){
			event.preventDefault();

			var tel = document.getElementById('tel').value;

			var telefono = `<tr>
						 <td>${tel}</td>
						 <td>
							<button class="btnDel">Delete</button>
							<input type="hidden" value="${tel}" name="Telefonos[]">
						 </td>
					   </tr>`;

			document.getElementById('bodyTable').insertAdjacentHTML('beforeend', telefono);
		});

		document.getElementById('tTabla').addEventListener('click', function(event){
			event.preventDefault();

			if(event.target.classList.contains('btnDel'))
			{
				var parent = event.target.parentElement.parentElement;
				parent.remove();
			}
		});
	</script>
<?php require "view/footer.php";?>