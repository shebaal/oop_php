<?php 
	session_start();
	$db = mysqli_connect('localhost', 'root', '', 'product_php');

	// initialize variables
	// $name = "";
	$name = "";
	$description = "";
	$category_id = "";
	$image = "";
	$id = 0;
	$update = false;
	$update2 = false;

	if (isset($_POST['save'])) {
		$name = $_POST['name'];
		

		mysqli_query($db, "INSERT into category  (name) VALUES ('$name')"); 
		$_SESSION['message'] = "category saved"; 
		header('location: index.php');
	}

	else if (isset($_POST['save2'])) {
		$name = $_POST['name'];
		$description = $_POST['description'];
		$category_id = $_POST['category_id'];
		move_uploaded_file($_FILES["image"]["tmp_name"],"upload/" . $_FILES["image"]["name"]);			
		$image=$_FILES["image"]["name"];
	
		mysqli_query($db, "INSERT into product  (name,description,category_id,image) VALUES ('$name','$description','$category_id','$image')"); 
		$_SESSION['message'] = "product saved"; 
		header('location: product.php');
	}



	





?>