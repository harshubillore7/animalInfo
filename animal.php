<?php
// echo "<pre>"; print_r($_POST);
require 'connection.php';

$sql = "select * from data";


$result = mysqli_query($conn, $sql);

?>
<!DOCTYPE html>
<html>

<head>
	<title></title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<div class="main-div">
		<h2>List of animals</h2>
		<div>
			<table id="animals">
				<thead>
					<tr>
						<th>Id</th>
						<th>Name of animal</th>
						<th>Category</th>
						<th>Image</th>
						<th>Description</th>
						<th>Life Expectancy</th>
					</tr>
				</thead>
				<tbody>
					<?php 
						if (mysqli_num_rows($result) > 0) {
						  // output data of each row
							$i=1;
						  while($row = mysqli_fetch_assoc($result)) {
						  	echo "<tr><td>" . $i++. "</td>
									<td>" . $row["name"]. "</td>
									<td>" . $row["category"]. "</td>
									<td>". "<img src=".$row['image'].' width=50px height="50px">'."</td>
									<td>" . $row["description"]. "</td>
									<td>" . $row["lifeExp"]. "</td>
									</tr>";
						  }
						} else {
						  echo "No Record Found";
						}
					?>
				</tbody>
			</table>
		</div>
	</div>

</body>
</html>
