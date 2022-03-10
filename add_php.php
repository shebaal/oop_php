<!-- add -->
<?php

include_once("php_code.php");

if(isset($_POST['add_product'])) {	
	$name = mysqli_real_escape_string($db, $_POST['name']);
	$description = mysqli_real_escape_string($db, $_POST['description']);
	$category = mysqli_real_escape_string($db, $_POST['category']);
	move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
    $image=$_FILES["image"]["name"];	
	// checking empty fields
	if(empty($name) || empty($description) || empty($category) || empty($image)) {
				
		if(empty($name)) {
			echo "<font color='red'>Name field is empty.</font><br/>";
		}
		
		if(empty($description)) {
			echo "<font color='red'>description field is empty.</font><br/>";
		}
		
		if(empty($category)) {
			echo "<font color='red'>category field is empty.</font><br/>";
		}
		if(empty($image)) {
			echo "<font color='red'>image field is empty.</font><br/>";
		}
		//link to the previous page
		echo "<br/><a href='javascript:self.history.back();'>Go Back</a>";
	} else { 
		// if all the fields are filled (not empty) 
			
		//insert data to database	
		$result = mysqli_query($db, "INSERT INTO product (name,description,category_id,image) VALUES('$name','$description','$category','$image')");
		
		//display success message
		echo "<font color='green'>product added successfully.";
		echo "<br/><a href='product.php'>View Result</a>";
	}
}
?>