<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Insert (STATIC COMBO for Country)</h3>

	<p class="help">
		This versions adds a <b>static combo</b> (select input) to select the country.<br><br>
		
		Note that the combo display the names of the countries, but the GET paramenter sent to the webserver is the id of the country. 
	</p>
  	<hr><br>

<?php

	// Similar to previous versions
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);
	$query = "select friends.name AS name,
					 age,
					 countries.name AS country
			  from friends join countries on friends.country = countries.id";
	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table><tr><th>Friend</th><th>Age</th><th>Country</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
		echo "<td>".$row['name']."</td>";
		echo "<td>".$row['age']."</td>";
		echo "<td>".$row['country']."</td>";
		echo "</tr>";
	}
  
	echo "</table>";
?>

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i>insert</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
