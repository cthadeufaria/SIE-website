<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Update (TEXT INPUTS only)</h3>

	<p class="help">
		This version allow to update friend's data in table friends.<br><br>
		
		For the sake of simplicity, in this first update version, we only considered the text inputs Name and Age.<br><br>
		
		Note that there is a form and an action scripts for the update, and a form and an action script for insert.
	</p>
  <hr><br>

<?php

	// Similar to previous versions
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);
	$query = "select * from friends";
	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table><tr><th>Friend</th><th>Age</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['age']."</td>";
		echo "<td><a href='actionDeleteFriend.php?id=" . $row['id'] . "'>Delete</a></td>";
		echo "<td><a href='formUpdateFriend.php?id=" . $row['id'] . "'>Update</a></td>";
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