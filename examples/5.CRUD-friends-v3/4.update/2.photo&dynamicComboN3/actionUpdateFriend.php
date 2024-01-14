<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

		// *************  STEP 1: update the data fields

		// 1. Get the updated data entered in the form
		$id   		 = $_POST['friendId'];
		$name 		 = $_POST['friendName'];
		$age  		 = $_POST['friendAge'];
		$countryId   = $_POST['country'];

		// 2. Connect to the database
		$conn  = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		// 3. Create and execute the update query
		$updateQuery = "UPDATE friends
										SET name    = '" . $name . "',
										    age     = " . $age . ",
											country = " . $countryId . "
										WHERE id    = " . $id .";";

		echo "DEBUG: Update query = ".$updateQuery."<p>";

		$result = pg_exec($conn, $updateQuery);
		echo "DEBUG: Update query result = ".$result."<p>";

		// ***************  STEP 2: Upadte the photo

		if (!empty($_FILES["photo"]["name"]))  {			//If the user uploaded a photo in the form, then we should:

			// 1. Delete the file in folder photos corresponding to the user being updated
		  	$result = pg_exec($conn, "SELECT photo FROM friends WHERE id =" . $id);
			$row 	= pg_fetch_assoc($result);
			$photo  = $row['photo'];
			unlink('photos/' . $photo);				//Note: unlink() is the PHP command to delete a fle in the file system

			// 2. Add the prefix to the newly uploaded file (similar to the insert version)
			$filename = $id . "_" . $_FILES["photo"]["name"];
			$filename = str_replace(' ', '', $filename);          //remove spaces in the filename to avoid errors

			// 3. Move the file uploaded from the temp folder to its final destination (similar to the insert version)
			move_uploaded_file($_FILES["photo"]["tmp_name"], 'photos/' . $filename);

			// 4. Update column friends.photo with the new filename (similar to the insert version)
			$updateQuery = "UPDATE friends SET photo = '" . $filename . "' WHERE id = " . $id;
			echo "DEBUG: Update query = ".$updateQuery."<p>";

			$result = pg_exec($conn, $updateQuery);
		}

		// 4. Close the connection to the database
		pg_close($conn);

	?>






  <p>_____________________________________<p>
	<p><a href = "listFriends.php">Return to home page</a></p>
	<p><a href = "./..">Return to example root</a></p>

</body>
</html>
