<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>List and SEARCH friends</h3>

	<p class="help">
		This version adds a new form with a text input where the user may enter the name he wants to search for.<br><br>

		The <b>important point</b> here is the creation of the <b>dynamic query</b>.<br>
		Pay special attention to it (line 39 onwards).
	</p>
	<hr><br>

  <!--NEW: form to enter friend's name -->
	<form method = "GET"  action = "2.list&searchFriendsN1.php">

			<p>Enter the name of your friend:</p>
			<input type = "text" name = "friendName">
			<input type = "submit" value = "OK">

	</form>
	<hr><br>

<?php

// *********************  1. Get the data from the database

	//	1. Open the connection to the database
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");

	// 	2. Create and execute the SQL query to move to the appropriate schema
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);


	//	3. NEW: now, the SQL query is dynamic as it depends on the data entered by the user in the form

	if ( !empty($_GET['friendName']) )													// ! is PHP's NOT operator. So, the condition will be TRUE if $_GET['friendName is not empty, i.e., if the user entered a in the text input friendName
     	$query = "select * from friends where name = '". $_GET['friendName'] ."'";				
	else
     	$query = "select * from friends";

	//echo "DEBUG: query: " . $query . "<br><br>";


	//  4. Execute the query and get its result
	$result = pg_exec($conn, $query);
  
	//echo "DEBUG: numRows: " . pg_numrows($result) . "<br><br>"; 

	//  5. Close the connection to the database
	  pg_close($conn);


	// *********************  2. Generate the html table: SIMILAR TO PREVIOUS VERSION with fetch_assoc

	echo "<table border=1>";

	echo "<tr>";
		echo "<th>Friend</th><th>Age</th>";
	echo "</tr>";

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

	<br><p>__________________</p>
	<a href=".">Return to the home of the <i>read</i> examples</a><br><br>
	<a href="..">Return to the root of the <i>CRUD</i> example</a>

</body></html>