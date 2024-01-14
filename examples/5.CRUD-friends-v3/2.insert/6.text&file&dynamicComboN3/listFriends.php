<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Insert (DYNAMIC COMBO + FILE UPLOAD)</h3>

	<p class="help">
		This version puts together the previous versions, as the insert form now contains the text inputs, the dynamic combo and the fie upload.
	</p>
  <hr><br>

<?php

	// Similar to previous version
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);
	$query = "select friends.name AS friend_name, age, photo, countries.name AS country_name from friends join countries on friends.country = countries.id";
	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<tr><th>Photo</th><th>Friend</th><th>Age</th><th>Country</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
			echo "<td><div class=\"photo\" style=\"background-image:url('../../photos/" . $row['photo'] . "')\"></div></td>";
			echo "<td>".$row['friend_name']."</td>";
			echo "<td>".$row['age']."</td>";
			echo "<td>".$row['country_name']."</td>";
		echo "</tr>";
	}

  echo "</table>";
  echo "<br>";

?>

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>insert</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>

