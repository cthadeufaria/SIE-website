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

	<form method = "POST" action = "actionInsertFriend.php">

		<h3>Insert a new friend form</h3>

		<table>

			<tr><td>Name:</td><td><input type = "text" name = "friendName"></td></tr>

			<tr><td>Age</td><td><input type = "text" name = "friendAge"></td></tr>

			<tr>
				<td>Country</td>
				<td>
					<Select name="country">
						<option value=1>Portugal</option><br>
						<option value=2>France</option><br>
						<option value=3>UK</option><br>
						<option value=4>Spain</option><br>
						<option value=7>Germany</option><br>
						<option value=8>Ukraine</option><br>
						<option value=9>Italy</option><br>
					</Select>
			 </td>
			</tr>

		<tr>
			<td></td>
			<td style="align:left"><input type = "submit" value = "Add friend"></td>
		</tr>

		</table>

	</form>

</body>
</html>
