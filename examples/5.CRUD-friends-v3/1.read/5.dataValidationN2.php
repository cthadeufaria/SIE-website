<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>List and search with DATA VALIDATION</h3>

	<p class="help">
		This version performs data validation.<br><br>

		An error message is generated when:<br>
     	 - the user clicks the submit button and the search string is empty,<br>
		 - or the query returns no records.<br><br>

		 All records in the DB are displayed when:<br>
		 - the page is direcly invoked in the browser by its URL<br>
		 - the search string equals ALL.
	</p>
	<hr><br>

	<form method = "GET"  action = "5.dataValidationN2.php">
			<p>Enter the name of your friend:</p>
			<input type="text"   name="friendName">
			<input type="submit" name="submit" value="OK">
	</form>
	<hr><br>

<?php
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
  	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);

	$error = "noError";   //variable $error contains the value of the error (noError by default)

	if ( !empty($_GET['submit']) && empty($_GET['friendName']) )
			$error = "noInputError";      //button submit was clicked with an empty search string

  	if ( !empty($_GET['submit']) && !empty($_GET['friendName']))
			if ($_GET['friendName'] == "ALL")
				$query = "select * from friends";  //button submit was clicked and the search string in the text input is ALL
      		else
				$query = "select * from friends where name = '". $_GET['friendName'] ."'";  //button submit was clicked with a search string other than ALL

	if ( empty($_GET['submit']) )						// if the sub,it button was not clicked (the page was invoked directly by the URL), all the records are displayed
		    $query = "select * from friends";

  	if ($error != "noInputError") {						// the query is invoked only if there was not an input error	(submit  clicked with an empty search string)
		
		$result = pg_exec($conn, $query);
  	 	pg_close($conn);

  		$numberOfRows = pg_numrows($result);
		if ($numberOfRows == 0)
			$error = "noRecordsError";
    }

	if ($error == "noInputError")
	   echo "<p class='errorMsg'>You didn't specify a search string.<br><br>Please try again!</p>";
  	elseif ($error == "noRecordsError")
		echo "<p class='errorMsg'>Sorry, we didn't find any record in the DB corresponding to your search string.<br><br>Please try again!</p>";
	else {
		echo "<table border=1>";
				echo "<tr>";
		echo "<th>Photo</th><th>Friend</th><th>Age</th>";
	  	echo "</tr>";

		for($i=0; $i<$numberOfRows; $i++) {
				$row = pg_fetch_assoc($result);
				echo "<tr>";
				echo "<td><div class=\"photo\" style=\"background-image:url('../photos/" . $row['photo'] . "')\"></div></td>";
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

