<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

	// In this script, everything is identical to previous version except the fact that now the
	// insert query includes the id of the country selected by the user in the country combo


		// STEP 1.
		$name 	 	= $_POST['friendName'];
		$age  	 	= $_POST['friendAge'];
		$countryId  = $_POST['country'];

		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		$insertQuery = "INSERT INTO friends (name, age, country) VALUES ('". $name ."', " . $age . ", " . $countryId . ") RETURNING id";
		echo "DEBUG: Insert query = ".$insertQuery."<p>";
		$result = pg_exec($conn, $insertQuery);

		$row = pg_fetch_assoc($result);
		$idNewFriend = $row['id'];

 		// STEP 2.
		if (!empty( $_FILES["photo"]["name"]))  {

				$filename = $idNewFriend . "_" . $_FILES["photo"]["name"];
				$filename = str_replace(' ', '', $filename);

				move_uploaded_file($_FILES["photo"]["tmp_name"], '../../photos/' . $filename);

				$updateQuery = "UPDATE friends SET photo = '" . $filename . "' WHERE id = " . $idNewFriend;
				echo "DEBUG: Update query = ".$updateQuery."<p>";
				pg_exec($conn, $updateQuery);
    }

		pg_close($conn);

	?>

<p>__________________</p>
<p><a href = "listFriends.php">Return to List Friends page</a></p>

</body></html>
