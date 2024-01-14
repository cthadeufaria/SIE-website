<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

   // To ensure that every photo has a different filename, we add the prefix "id_" to the original name of the file uploaded by the user
   // This present a difficulty as  we don't know the id of the new friends record before inserting it.
   // As so, we have to proceed in two steps:
   //   STEP 1. insert the new record in table friends with the column photo empty, and get its id (pay attention to the RETURNING clause in the insertQuery below)
   //   STEP 2. change the name of file, move it to the photo folders, and update the column photo in table friends
   //   _____________________________________________________________________________________________________________



	 // STEP 1.
		$name 	 = $_POST['friendName'];
		$age  	 = $_POST['friendAge'];

		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		$insertQuery = "INSERT INTO friends (name, age) VALUES ('". $name ."', " . $age . ") RETURNING id";   // <-- Pay attention to retuning id
		echo "DEBUG: Insert query = ".$insertQuery."<p>";

		$result = pg_exec($conn, $insertQuery);
		echo "DEBUG: Insert query result = ".$result."<p>";

    	// Get the id of the new record
		$row = pg_fetch_assoc($result);
		$idNewFriend = $row['id'];
		echo "DEBUG: idNewFriend = " . $idNewFriend . "<p>";

 		// STEP 2.

		// 1. Check if the user uploaded a file
		if (!empty($_FILES["photo"]["name"])) 	{   // if the user uploaded a file

				// add prefix "id_" to the original name of the file uploaded by the user
				$filename = $idNewFriend . "_" . $_FILES["photo"]["name"];
				$filename = str_replace(' ', '', $filename);          //remove spaces in the filename to avoid errors

        		// move the file uploaded to the folder photos
				move_uploaded_file($_FILES["photo"]["tmp_name"], '../../photos/' . $filename);

				// update column photo in table friends
				$updateQuery = "UPDATE friends SET photo = '" . $filename . "' WHERE id = " . $idNewFriend;
				echo "DEBUG: Update query = ".$updateQuery."<p>";

				$result = pg_exec($conn, $updateQuery);
				echo "DEBUG: Update query result = ".$result."<p>";
    	}

		pg_close($conn);
	?>

<p>__________________</p>
<p><a href = "listFriends.php">Return to List Friends page</a></p>

</body>
</html>
