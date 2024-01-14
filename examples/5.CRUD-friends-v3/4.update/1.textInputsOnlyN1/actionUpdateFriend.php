<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

		// 1. Get the id of the friend to update
		$id = $_GET['friendId'];
		$name = $_GET['friendName'];
		$age = $_GET['friendAge'];

		// 2. Connect to the database
		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		// 3. Create and execute the update query
		$updateQuery = "UPDATE friends
										SET name = '" . $name . "', age = " . $age .
										" WHERE id = " . $id .";";
		echo "DEBUG: Update query = ".$updateQuery."<p>";

		$result = pg_exec($conn, $updateQuery);

		// 4. Close the connection to the database
		pg_close($conn);

	?>

	<p><a href = "listFriends.php">Return to home page</a></p>
	<p><a href = "./..">Return to example root</a></p>

</body>
</html>
