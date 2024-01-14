<html>
<head>
	<meta charset="UTF-8">
	<link rel="stylesheet" type="text/css" href="../../style1.css">

	<style>
		table, th, tr, td { border:0px;
		}	
	</style>
	
</head>

<body>

	<form method = "POST" action = "actionInsertFriend.php" enctype="multipart/form-data">

		<h3>Insert a new friend form</h3>

		<table>

			<!-- Name and Age text inputs -->			
			<tr><td>Name:</td><td><input type = "text" name = "friendName"></td></tr>
			
			<tr><td>Age</td><td><input type = "text" name = "friendAge"></td></tr>

			<!-- Photo input -->
      		<tr><td>Photo</td><td><input type="file" name="photo"></td></tr>
			
			<tr><td></td><td style="align:left"><input type = "submit" value = "Add friend"></td></tr>

		</table>

	</form>

</body>
</html>
