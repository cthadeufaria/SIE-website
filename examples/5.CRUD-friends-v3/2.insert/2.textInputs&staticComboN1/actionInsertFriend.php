<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">

</head>

<body>
	<?php

		// 1. Get data entered by the user in the form inputs
		$name 	 	= $_POST['friendName'];
		$age  	 	= $_POST['friendAge'];
		$countryId  = $_POST['country'];

		// 2. Connect to the database
		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		// 3. Execute the insert query
		$insertQuery = "INSERT INTO friends (name, age, country) VALUES ('". $name ."', " . $age . ", " . $countryId . ")";
		echo "DEBUG: Insert query = ".$insertQuery."<p>";

		$result = pg_exec($conn, $insertQuery);

		// 4. Close the connection to the database
		pg_close($conn);

	?>

<p>__________________</p>
<p><a href = "listFriends.php">Return to List Friends page</a></p>

</body></html>
