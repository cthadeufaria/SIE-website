<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>LIST All friends</h3>

	<p class="help">
		This version displays all friends (records) existing in the table friends of the DB.<br><br>

		The base version employs function <b>pg_fetch_row</b>.<br><br>
		An alternative version employing <b>pg_fetch_assoc</b> is also provided at the end of the script.
	</p>
	<hr><br>

	<?php

		// *********************  1. Get the data from the database

		//	1. Open the connection to the database
			$conn = pg_connect("host=db.fe.up.pt dbname=sie2345 user=sie2345 password=lxymJAoi");

		// 	2. Create and execute the SQL query to move to the appropriate schema
			$query = "set schema 'demosPHP'";
			pg_exec($conn, $query);

		//	3. Create and execute the SQL select query that retrieves all the records in table friends
			$query = "select * from friends";
			$result = pg_exec($conn, $query);

		//	4. Close the connection to the database (no longer needed)
			pg_close($conn);


		//  *********************  2. Generate the html table displaying the result of the query

		// 	1. Table begin and headers
			echo "<table>";
			echo "<tr><th>Friend</th><th>Age</th></tr>";

		//	2. Table rows (the nr depends on the rows returned by the query)

		//  2.1. Get the number of rows returned by the query
			$numberOfRows = pg_numrows($result);

		//  2.2. Generate the HTML table with one row per each row in the result (using FETCH_ROW)
			for($i=0; $i<$numberOfRows; $i++) {

				$row = pg_fetch_row($result, $i);

				echo "<tr>";
				echo "<td>".$row[1]."</td>";		
				echo "<td>".$row[2]."</td>";		
				echo "</tr>";
			}

		//	3. Table end
			echo "</table>";

		//  To test the FETCH_ASSOC version, comment sections 2.2 and 3 above, and uncomment the code below

		/*
		// 2.2a. Generate the HTML table with one row per each row in $result using FETCH_ASSOC.

			for($i=0; $i<$numberOfRows; $i++) {

				$row = pg_fetch_assoc($result);      //Note that with fetch_assoc we don't need to specify the nember of the row we want to get

				echo "<tr>";
				echo "<td>".$row['name']."</td>";	 //Note that with fetch_assoc we access the columns by their names
				echo "<td>".$row['age']."</td>";	 //instead of the indexes
				echo "</tr>";
			}

		//	3a. Table end
			echo "</table>";

			*/

	?>

	<br><p>__________________</p>
	<a href=".">Return to the home of the <i>read</i> examples</a><br><br>
	<a href="..">Return to the root of the <i>CRUD</i> example</a>

</body></html>
