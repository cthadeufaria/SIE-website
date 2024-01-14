<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Insert with PHOTO UPLOAD - FULL version</h3>

	<p class="help">
		This is a more sophisticated version of the file upload, the user may upload a photo when inserting a new friend.<br><br>

		To ensure that every photo has a different filename, the prefix "id_" is added to the original name of the uploaded file.<br><br>

		This present a difficulty as we don't know the id of the new friends record before inserting it.<br><br>

		To circumvent this, we'll proceed in two steps in the action script (see actionInsertFriend.php):<br><br>
		
		STEP 1. insert the new record in table friends with the column photo empty, and get its id (see the RETURNING clause in the insert query<br><br>
		
		STEP 2. change the name of file, move it to the photo folders, and update the column photo in table friends.

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

<p><a href="formInsertFriend.php">New friend</a></p>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>insert</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
