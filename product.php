<!DOCTYPE html>
<?php  include('php_code.php'); ?>
<html>
<head>
	<title>Categories</title>
    <link rel="stylesheet" type="text/css" href="style.css">
	<link href="/dist/output.css" rel="stylesheet">
	
<script src="https://cdn.tailwindcss.com"></script>
</head>
<body>
<?php if (isset($_SESSION['message'])): ?>
	<div class="msg">
		<?php 
			echo $_SESSION['message']; 
			unset($_SESSION['message']);
		?>
	</div>
<?php endif ?>


<?php $results = mysqli_query($db, "SELECT * FROM product"); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update2 = true;
		$record = mysqli_query($db, "SELECT * FROM product WHERE id=$id");

		if (count(array($record)) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
			$description = $n['description'];
			$category_id  = $n['category_id'];
			// $image = $n['image'];
			$image = 'uploads/'.$n["image"];
		}
	}
	if (isset($_POST['update2']) || !empty($_FILES["image"]["name"])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
		$description = $_POST['description'];
		$category_id  = $_POST['category_id '];
		$image = $_POST['image'];
	
		mysqli_query($db, "UPDATE product SET name='$name',description='$description',category_id='$category_id',image='$image' WHERE id=$id");
		$_SESSION['message'] = "product name updated!"; 
		header('location: product.php');
	}
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM product WHERE id=$id");
		$_SESSION['message'] = "product deleted!"; 
		header('location: product.php');
	}
?>
<table>
	<thead>
		<tr>
			<th>Name</th>
			<th>description</th>
			<th>category</th>
			<th>image</th>
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
			<td><?php echo $row['description']; ?></td>
			<td><?php echo $row['category_id']; ?></td>
        	<?php	echo '<td><img src="upload/'. $row['image'].'" style=" border: 5px solid #eee;box-shadow: 3px 4px 3px rgba(0, 0, 0, 0.3);width: 100px;height: 100px;" /></td>';   ?>
	
			
            
			<td>
				<a href="product.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="product.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>

	<form method="post" action="product.php" enctype="multipart/form-data" >
		
<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>product</label>
			
           <input type="text" name="name" value="<?php echo $name; ?>">
           <input type="text" name="description" value="<?php echo $description; ?>">
           <input type="text" name="category_id" value="<?php echo $category_id; ?>">
           <input type="file" name="image" value="<?php echo $image; ?>">
		   

		</div>
	
		<div class="input-group">
		<?php if ($update2 == true): ?>
	<button class="btn" type="submit" name="update2" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button  type="submit" name="save2" class="box-border h-32 w-32 p-4 border-4 bg-red-500" >Save</button>
<?php endif ?>
		</div>
	</form>




</body>
</html>