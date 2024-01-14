<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../style1.css">
</head>

<body>

	<h3>List with PHOTOS</h3>

	<p class="help">In this version, the HTML table contains a new column showing the photos of the friends.<br><br>

		Note that:<br><br>
     	 - as we saw in the CSS lessons, photos are <b>displayed as the background of a div</b>, not as an img element.<br><br>
		 - the photos are kept in a regular folder of the file system.<br><br>
		 - table friends only contains the filename of the corresponding photo, not the photo itself.<br><br>

		 Pay attention to the ECHO instruction that generates the div's displaying the photos as background (line 65 onwards).<br>
		 This instruction is somehow complex due to the <i>strings within strings</i><br>

		 To help on the analysis of the ECHO instruction, a static example is provided embedded in the code so that you can compare 
		 the static and the dynamic versions.
	</p>
	<hr><br>

 	<!-- FORM: this is identical to the previous version -->
	<form method = "GET"  action = "4.listWithPhotos.php">

		<p>Enter the name of your friend:</p>
		<input type = "text" name = "friendName">
		<input type = "submit" value = "OK">

	</form>
	<hr><br>

<?php

// Get data from DB: this is also identical to the previous version

   $conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");

   $query = "set schema 'demosPHP'";
	pg_exec($conn, $query);

	if ( !empty($_GET['friendName']) )
     	$query = "select * from friends where name = '". $_GET['friendName'] ."'";
	else
     	$query = "select * from friends";

	$result = pg_exec($conn, $query);

  pg_close($conn);


// NEW: Generate the html table with a NEW COLUMN FOR THE PHOTO
	echo "<table border=1>";

	echo "<tr>";
		echo "<th>Photo</th><th>Friend</th><th>Age</th>";
	echo "</tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
 		$row = pg_fetch_assoc($result);

 		echo "<tr>";
		//Pay attention here: compare the static and the dynamic versions of the HTML code that displays a photo in a cell of the table
		//STATIC: <div class="photo" style="background-image:url('photos/201806652.jpg')"></div>
		echo "<td><div class=\"photo\" style=\"background-image:url('../photos/" . $row['photo'] . "')\"></div></td>";
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

