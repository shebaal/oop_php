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


<?php $results = mysqli_query($db, "SELECT * FROM category"); ?>
<?php 
	if (isset($_GET['edit'])) {
		$id = $_GET['edit'];
		$update = true;
		$record = mysqli_query($db, "SELECT * FROM category WHERE id=$id");

		if (count(array($record)) == 1 ) {
			$n = mysqli_fetch_array($record);
			$name = $n['name'];
		}
	}
	if (isset($_POST['update'])) {
		$id = $_POST['id'];
		$name = $_POST['name'];
	
		mysqli_query($db, "UPDATE category SET name='$name' WHERE id=$id");
		$_SESSION['message'] = "category name updated!"; 
		header('location: index.php');
	}
	if (isset($_GET['del'])) {
		$id = $_GET['del'];
		mysqli_query($db, "DELETE FROM category WHERE id=$id");
		$_SESSION['message'] = "category deleted!"; 
		header('location: index.php');
	}
?>
<table>
	<thead>
		<tr>
			<th>Name</th>
            
			<th colspan="2">Action</th>
		</tr>
	</thead>
	
	<?php while ($row = mysqli_fetch_array($results)) { ?>
		<tr>
			<td><?php echo $row['name']; ?></td>
            
			<td>
				<a href="index.php?edit=<?php echo $row['id']; ?>" class="edit_btn" >Edit</a>
			</td>
			<td>
				<a href="index.php?del=<?php echo $row['id']; ?>" class="del_btn">Delete</a>
			</td>
		</tr>
	<?php } ?>
</table>


	<form method="post" action="index.php" >
		
<input type="hidden" name="id" value="<?php echo $id; ?>">
		<div class="input-group">
			<label>category</label>
			
<input type="text" name="name" value="<?php echo $name; ?>">

		</div>
	
		<div class="input-group">
		<?php if ($update == true): ?>
	<button  type="submit" name="update" style="background: #556B2F;" >update</button>
<?php else: ?>
	<button  type="submit" name="save" class="box-border h-32 w-32 p-4 border-4 bg-red-500">Save</button>
<?php endif ?>
		</div>
	</form>





</body>
</html>