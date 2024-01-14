<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">

	<style>
		table, th, tr, td { border:0px;
		}	
	</style>
	
</head>

<body>

	<form method = "POST" action = "actionInsertFriend.php" enctype="multipart/form-data">

		<h3>Insert a new friend form</h3>

		<table>

			<tr><td>Name:</td><td><input type = "text" name = "friendName"></td></tr>

			<tr><td>Age</td><td><input type = "text" name = "friendAge"></td></tr>

			<tr>
				<td>Country</td>
				<td>
					<Select name="country">

						<?php
							// 1. Get the countries in DB table countries
							$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
							pg_exec($conn, "set schema 'demosPHP'");
							$result = pg_exec($conn, "SELECT * FROM countries");

							// 2. Generate one option in the combo per country in the db
							for($i=0; $i<pg_numrows($result); $i++) {
								$row = pg_fetch_assoc($result);
								echo '<option value = "' . $row['id'] . '">' . $row['name'] . '</option><br>';
							}
						?>
					</Select>
			 	</td>
			</tr>

			<tr><td>Photo</td><td><input type="file" name="photo"></td></tr>

			<tr><td></td><td style="align:left"><input type = "submit" value = "Add friend"></td></tr>

		</table>

	</form>

</body>
</html>
