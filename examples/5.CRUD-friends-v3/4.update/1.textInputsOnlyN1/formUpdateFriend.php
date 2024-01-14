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

  <?php
			// 1. Get the id of the friend to update
			$id = $_GET['id'];

			// 2. Connect to the database
			$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
			$query = "set schema 'demosPHP'";
			pg_exec($conn, $query);

			// 3. Create and execute the select query to get the current data of the friend to be updated
			$selectQuery = "SELECT * FROM friends WHERE id = " . $id;
			echo "DEBUG: SELECT query = ".$selectQuery."<p>";

			$result = pg_exec($conn, $selectQuery);
			echo "DEBUG: Delete query result = ".$result."<p>";

			// 4. Close the connection to the database
			pg_close($conn);

			$row  = pg_fetch_assoc($result);
			$id   = $row['id'];
			$name = $row['name'];
			$age  = $row['age'];

			?>

			<form method = "GET" action = "actionUpdateFriend.php">

				<h3>Update friend form</h3>

				<table>

					<tr><td>Name:</td><td><input type = "text" name = "friendName" value = "<?php echo $name; ?>" ></td></tr>

					<tr><td>Age:</td><td><input type = "text" name = "friendAge" value = "<?php echo $age; ?>" ></td></tr>

					<tr><td></td><td style="align:left"><input type = "submit" value = "Update friend"></td></tr>

				</table>

				<!-- Pay attention to field friendId below: it has the property hidden so it is not shown to
					 the user.
					 However, as it is a field of the form, its value will be send to the server via GET,
					 This way, the PHP script will know the id of the user being updated.
				-->

				<input type="text" hidden name="friendId"	value=<?php echo "\"".$id."\"";?>></input>


			</form>


	</body>
	</html>
