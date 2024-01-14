<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>
	<?php

   	//  HELP HELP HELP   
   	//  _____________________________________________________________________________________________________________


		$name 	 = $_POST['friendName'];
		$age  	 = $_POST['friendAge'];

		$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
		$query = "set schema 'demosPHP'";
		pg_exec($conn, $query);

		if (!empty($_FILES["photo"]["name"])) 	{   // if the user uploaded a file then ...

			$filename = $_FILES["photo"]["name"];

			// move the file uploaded to the folder photos
			move_uploaded_file($_FILES["photo"]["tmp_name"], '../../photos/' . $filename);

			$insertQuery = "INSERT INTO friends (name, age, photo) VALUES ('". $name ."', " . $age . ", '" . $filename . "')"; 
			echo "<p>DEBUG: Insert query = " . $insertQuery . "</p>";
			pg_exec($conn, $insertQuery);
		}

		pg_close($conn);

	?>

<p>__________________</p>
<p><a href = "listFriends.php">Return to List Friends page</a></p>

</body></html>
