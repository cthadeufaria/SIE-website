<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Insert with PHOTO UPLOAD (SIMPLE version))</h3>

	<p class="help">
		Now, in the insert form the user may upload the photo of his friend.<br><br>

		In the form script see the new control type = file.<br><br>

		In the action script, be aware of the following new features:<br><br>

		- the GET variable $_FILES["photo"]["name"] contains the name of the file uploaded by the user;<br><br>
		- when a new file is uploaded in a forma, the webserver saves it in a temporary folder and assign it a random name;<br><br> 
		- this name of the file is available in GET $_FILES["photo"]["tmp_name"];<br><br>
		- the PHP script should move this file to the application's photos folder using the function move_uploaded_file.
	</p>
  <hr><br>

<?php

	// Similar to 1.read/3.listWithPhotos
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);
	$query = "select * from friends";
	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table>";

	echo "<tr><th>Photo</th><th>Friend</th><th>Age</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
			echo "<td><div class=\"photo\" style=\"background-image:url('../../photos/" . $row['photo'] . "')\"></div></td>";
			echo "<td>".$row['name']."</td>";
			echo "<td>".$row['age']."</td>";
		echo "</tr>";
	}
  echo "</table>";

?>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>insert</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>

