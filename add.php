<!DOCTYPE html>
<html lang="en">
	<?php include_once("php_code.php"); ?>
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
    
	<form action="add.php" method="post" name="form1" enctype="multipart/form-data">
		<table width="25%" border="0">
			<tr> 
				<td>Name</td>
				<td><input type="text" name="name"></td>
			</tr>
			<tr> 
				<td>description</td>
				<td><input type="text" name="description"></td>
			</tr>
			<tr> 
				<td>category</td>
				<td><input type="text" name="category"></td>
			</tr>
			<tr> 
				<td>image</td>
				<td><input type="file" name="image"  ></td>
			</tr>
			<tr> 
				<td></td>
				<td><input type="submit" name="add_product" value="Add"></td>
			</tr>
		</table>
	</form>
</body>
</html>