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

			$row  	   = pg_fetch_assoc($result);

			$id   		 = $row['id'];
			$photo		 = $row['photo'];
			$name 		 = $row['name'];
			$age  		 = $row['age'];
			$idCountry   = $row['country'];

	?>

			<form method = "POST" action = "actionUpdateFriend.php" enctype="multipart/form-data">

				<h3>Update friend with PHOTO AND DYNAMIC COMBO</h3>

				<table>

					<tr>
						<td>Photo:</td>
				    	<td>
							 <!--	STATIC example: <div class="photo" style="background-image:url('photos/201800185.jpg')"></div> -->
							 <div class="photo" style="background-image:url('photos/<?php echo $photo;?>')"></div><br>
							 <input type="file" name="photo">
						</td>
					</tr>

					<tr><td>Name:</td><td><input type = "text" name = "friendName" value = "<?php echo $name; ?>" ></td></tr>

					<tr><td>Age:</td><td><input type = "text" name = "friendAge" value = "<?php echo $age; ?>" ></td></tr>

					<tr>
						<td>Country</td>
						<td>
							<select name="country">

								<?php

									$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
									pg_exec($conn, "set schema 'demosPHP'");
									$result = pg_exec($conn, "SELECT * FROM countries");

									for($i=0; $i<pg_numrows($result); $i++) {
										$row = pg_fetch_assoc($result);

										// IMPORTANT: note that we should mark as selected the combo option corresponding to the current value of country saved in the DB
										if ($row['id'] == $idCountry)
											echo '<option value = "' . $row['id'] . '" selected>' . $row['name'] . '</option><br>';
										else
											echo '<option value = "' . $row['id'] . '">' . $row['name'] . '</option><br>';
									}
								?>

							</select>
					 	</td>
					</tr>

					<tr>
						<td></td>
						<td style="align:left"><input type="submit" name="confirm" value="Confirm">&nbsp<input type="submit" name="cancel" value="Cancel"></td>
					</tr>
				</table>

				<!-- Pay attention to field friendId below: it has the property hidden so it is not shown to the user.
					   However, as it is a field of the form, its value will also be send to the server.
					   This way, the PHP script will know the id of the user being updated!				-->

				<input type="text"   hidden name="friendId"	value=<?php echo "\"".$id."\"";?>></input>

			</form>

	</body>
	</html>
