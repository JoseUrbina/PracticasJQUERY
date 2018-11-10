<?php
	$con = new mysqli("localhost", "root", "");

	if($con->errno)
	{
		die("Error: {$con->error}");
	}

	if(isset($_POST['btnExport']))
	{
		$con->select_db("Chess") or die("NOT FOUND");
		$con->set_charset("utf8");

		$query = "SELECT idBrand, brandName FROM Brand ORDER BY idBrand ASC";

		$result = $con->query($query);
		$output = '';

		if($result->num_rows)
		{
			$output .= '<table bordered="1">
							<tr>
								<th>ID</th>
								<th>Brand</th>
							</tr>
						';
			while($row = $result->fetch_array(MYSQLI_ASSOC)){
				$output .= "<tr>
								<td>{$row['idBrand']}</td>
								<td>{$row['brandName']}</td>
							</tr>";
			}

			$output .= "</table>";
		}
	}

	$con->close();

	header("Content-type:application/xls");
	header("Content-Disposition: attachment; filename = download.xls");
	echo $output;