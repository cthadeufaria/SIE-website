<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>Delete</h3>

	<p class="help">
		This version adds the possibility of deleting a friend in table friends.<br><br>

		For the sake of simplicity, we didn't included the country combo.<br><br>

		The delete action:<br>
		- first deletes friend's photo in folder photos using the unlink() php function (this function deletes a file in the file system);<br>
		- the deletes friend's record in table friends. 
	</p>
  <hr><br>

  <?php

	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);
	$query = "select * from friends";
	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table><tr><th>Photo</th><th>Friend</th><th>Age</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
			echo "<td><div class=\"photo\" style=\"background-image:url('../photos/" . $row['photo'] . "')\"></div></td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['age']."</td>";
			echo "<td><a href='actionDeleteFriend.php?id=" . $row['id'] . "'>Delete</a></td>";
		echo "</tr>";
	}
	echo "</table>";

?>

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href=".">Return to the root of the <i/>delete</i> examples</a><br><br>
<a href="..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
