<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

		// 1. Get the id of the friend to delete
		$id = $_GET['id'];

		// 2. Connect to the database
		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		// 3. Create and execute the detete query
		$deleteQuery = "DELETE FROM friends WHERE id = " . $id;
		echo "DEBUG: Delete query = ".$deleteQuery."<p>";

		$result = pg_exec($conn, $deleteQuery);

		// 4. Close the connection to the database
		pg_close($conn);

	?>

<p>__________________</p>
<p><a href = "listFriends.php">Return to List Friends page</a></p>

</body></html>
