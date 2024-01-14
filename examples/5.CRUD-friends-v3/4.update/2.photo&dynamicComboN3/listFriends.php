<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Update (PHOTO AND DYNAMIC COMBO)</h3>

	<p class="help">
		This version adds the dynamic combo for the country in the insert and delete forms.
	</p>
  <hr><br>

<?php

	// Get from DB the data needed to generate the table listing the friends (name, age and country)
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);

	$query = "SELECT friends.id 	AS friends_id,
					 friends.name 	AS friends_name,
					 friends.age 	AS friends_age,
					 friends.photo 	AS friends_photo,
					 countries.id 	AS countries_id,
					 countries.name AS countries_name
				FROM   		friends
				LEFT JOIN 	countries
				ON	   		friends.country = countries.id;";


	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table><tr><th>Photo</th><th>Friend</th><th>Age</th><th>Country</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
		echo "<td><div class=\"photo\" style=\"background-image:url('../../photos/" . $row['friends_photo'] . "')\"></div></td>";
		echo "<td>".$row['friends_name'] ."</td>";
		echo "<td>".$row['friends_age']  ."</td>";
		echo "<td>".$row['countries_name'] ."</td>";
		echo "<td><a href='actionDeleteFriend.php?id=" . $row['friends_id'] . "'>Delete</a></td>";
		echo "<td><a href='formUpdateFriend.php?id="   . $row['friends_id'] . "'>Update</a></td>";
		echo "</tr>";
	}
  echo "</table>";
	echo "<br>";

?>

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>update</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
