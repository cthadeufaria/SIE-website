<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">
</head>

<body>

	<h3>Update (CANCEL/CONFIRM buttons and AUTO REDIRECT to home page)</h3>

	<p class="help">
		
	This version adds to new simple features to the previous version: (i)Cancel and Confirm buttons and (ii)Page redirect<br><br>

	(i) The insert and update forms now contain two submit buttons: Confirm and Cancel<br><br>

    Both buttons invoke the corresponding update or insert action script. Both scripts start by testing which button was pressed:<br>
	- if it was Cancel, the page is immediately redirected to the home page<br>
	- if it was Confirm, the DBaction scripts for insert and are executed as in the previous versions. In the end, the page is redirected to the home page.<br><br>

	(ii) To redirect to execution to another script, the php function Header() is employed in the action scripts.<br><br>

	Also pay attention to the indentation of the select query below.  
	</p>
  <hr><br>

<?php

	// Get from DB the data needed to generate the table listing the friends (name, age and country)
	$conn = pg_connect("host=db.fe.up.pt dbname=jfaria user=jfaria password=jfaria");
	$query = "set schema 'demosPHP'";
	pg_exec($conn, $query);

	$query = "SELECT friends.id 	AS friends_id,
					 friends.name 	AS friends_name,
					 friends.age 	AS friends_age,
					 friends.photo 	AS friends_photo,
					 countries.id 	AS countries_id,
					 countries.name AS countries_name
				FROM   		friends
				LEFT JOIN 	countries
				ON	   		friends.country = countries.id;";

	$result = pg_exec($conn, $query);
	pg_close($conn);

	echo "<table>";
	echo "<tr><th>Photo</th><th>Friend</th><th>Age</th><th>Country</th></tr>";

	$numberOfRows = pg_numrows($result);
	for($i=0; $i<$numberOfRows; $i++) {
		$row = pg_fetch_assoc($result);
		echo "<tr>";
		echo "<td><div class=\"photo\" style=\"background-image:url('../../photos/" . $row['friends_photo'] . "')\"></div></td>";
		echo "<td>".$row['friends_name'] ."</td>";
		echo "<td>".$row['friends_age']  ."</td>";
		echo "<td>".$row['countries_name'] ."</td>";
		echo "<td><a href='actionDeleteFriend.php?id=" . $row['friends_id'] . "'>Delete</a></td>";
		echo "<td><a href='formUpdateFriend.php?id="   . $row['friends_id'] . "'>Update</a></td>";
		echo "</tr>";
	}
  echo "</table>";
?>

<p><a href="formInsertFriend.php">New friend</a></p><br>

<p>__________________</p>
<a href=".">Return to the home of <i>this</i> example</a><br><br>
<a href="..">Return to the root of the <i/>update</i> examples</a><br><br>
<a href="../..">Return to the root of the <i>CRUD</i> examples</a>
	
</body></html>
