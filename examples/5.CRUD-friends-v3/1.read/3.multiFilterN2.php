<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>List and search with MULTI FILTER</h3>

	<p class="help">
		This example shows how to handle search forms having <b>multiple filters</b>.<br><br>
		
		Look at version 2 (line 52 onwards), and see how this kind of multifilter can be handled quite easily (avoiding the "combinatory explosion").
	</p>
	<hr><br>

	<form method="GET"  action="3.multiFilterN1.php">

		<p>Search
		Name: <input type="text"    name="friendName" size=10 >&nbsp
		Age:  <input type="text"    name="friendAge"  size=4><br><br>
		      <input type="submit"  value = "OK">

	</form>
	<hr><br>

<?php

// *********************  1. Get the data from the database

//	1. Open the connection to the database and set the appropriate schema
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	pg_exec($conn, "set schema 'demosPHP'");



//	2. Select query: version 1 (very cumbersome when there are several search criteria)

	if ( !empty($_GET['friendName']) && !empty($_GET['friendAge']) )
     	$query = "SELECT * FROM friends WHERE name = '". $_GET['friendName'] ."' AND age = ". $_GET['friendAge'];

	if ( empty($_GET['friendName']) && !empty($_GET['friendAge']) )
		$query = "SELECT * FROM friends WHERE age = ". $_GET['friendAge'];

	if ( !empty($_GET['friendName']) && empty($_GET['friendAge']) )
		$query = "SELECT * FROM friends WHERE name = '". $_GET['friendName'] ."'";

	if ( empty($_GET['friendName']) && empty($_GET['friendAge']) )
		$query = "SELECT * FROM friends";


//	2. Select query: version 2 (much simpler)

//  To test this version, uncomment it and comment version 1

/*
	$query = "SELECT * FROM friends WHERE TRUE";

	if (!empty($_GET['friendName'])) $query = $query . " AND name = '". $_GET['friendName'] ."'";

	if (!empty($_GET['friendAge']))  $query = $query . " AND age = ". $_GET['friendAge'];
*/


//  4. Execute the query and get its result
	  $result = pg_exec($conn, $query);

//  5. Close the connection to the database
	  pg_close($conn);


// 6. Generate the html table: similar to previous version

	$numberOfRows = pg_numrows($result);

	if ($numberOfRows == 0)
		echo "No records found. Please try again";
	else {

		echo "<table border=1>";
		echo "<tr>";
			echo "<th>Friend</th><th>Age</th>";
		echo "</tr>";

		for($i=0; $i<$numberOfRows; $i++) {

			$row = pg_fetch_assoc($result);

			echo "<tr>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['age']."</td>";
			echo "</tr>";
		}

		echo "</table>";
	}

	?>

	<br><p>__________________</p>
	<a href=".">Return to the home of the <i>read</i> examples</a><br><br>
	<a href="..">Return to the root of the <i>CRUD</i> example</a>
	
</body></html>
