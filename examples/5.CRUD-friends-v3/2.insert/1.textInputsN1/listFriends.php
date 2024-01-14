<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Insert (TEXT INPUTs only)</h3>

	<p class="help">
	   This page has a new link in the bottom to the <b>insert form</b>.<br><br>

	   In this first version, the insert form only includes two text inputs for the Name and Age of the new friend.<br>
	   The inputs for the country and the photo will be added in later versions.<br><br>

	   Be aware that there are <b>2 new scripts</b>:<br>
	   - a <b>form</b> script, where the user enters the data<br><br>
	   - an <b>action</b> script that actually executes the query that inserts the new record in the DB.  
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
		echo "</tr>";
	}
  echo "</table>";

?>

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>insert</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
