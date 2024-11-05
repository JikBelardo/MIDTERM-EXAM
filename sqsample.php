
<?php require_once 'core\core.php'; ?>
<?php require_once 'core\models.php'; ?>
<?php require_once 'core\handleforms.php'; 

if (!isset($_SESSION['username'])) {
	header("Location: login.php");
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="sqsample.css">
	
	<style>
		body {
			font-family: "Arial";
		}
		input {
			font-size: 1.5em;
			height: 50px;
			width: 200px;
		}
		table, th, td {
		  border:1px solid black;
		  margin-bottom: 20px
		}
	</style>
    
</head>
<body>
<?php if (isset($_SESSION['message'])) { ?>
		<h1 style="color: red;"><?php echo $_SESSION['message']; ?></h1>
	<?php } unset($_SESSION['message']); ?>



	<?php if (isset($_SESSION['username'])) { ?>
		<h1>Hello there!! <?php echo $_SESSION['username']; ?></h1>
		<a href="core/handleforms.php?logoutAUser=1">Logout</a>
	<?php } else { echo "<h1>No user logged in</h1>";}?>

	<h3>Users List</h3>
	<ul>
		<?php $getAllUsers = getAllUsers($pdo); ?>
		<?php foreach ($getAllUsers as $row) { ?>
			<li>
				<a href="viewuser.php?user_id=<?php echo $row['user_id']; ?>"><?php echo $row['username']; ?></a>
			</li>
		<?php } ?>
	</ul>

<h1>Welcome To Car rental shop, please fill in the information below to rent a car</h1>
	<form action="core\handleforms.php" method="POST">
		<p>
			<label for="firstname">first name</label> 
			<input type="text" name="firstname">
		</p>
		<p>
			<label for="lastname">last name</label> 
			<input type="text" name="lastname">
		</p>
		<p>
			<label for="carmanufacturer">car manufacturer</label> 
			<input type="text" name="carmanufacturer">
		</p>
		<p>
			<label for="dateofrental">date of rental</label> 
			<input type="date" name="dateofrental">
		</p>
		<p>
			<label for="carmodel">car model</label> 
			<input type="text" name="carmodel">
		</p>
		<p>
			<label for="expectedreturn">expected return</label> 
			<input type="date" name="expectedreturn">
			<input type="submit" name="Btninsert">
		</p>
	</form>

	<?php $getAllWebDevs = getAllWebDevs($pdo); ?>
	<?php foreach ($getAllWebDevs as $row) { ?>
	<div class="container" style="border-style: solid; width: 50%; height: 380px; margin-top: 20px;">
		<h3>FirstName: <?php echo $row['first_name']; ?></h3>
		<h3>LastName: <?php echo $row['last_name']; ?></h3>
		<h3>car manufactuer: <?php echo $row['car_manufacturer']; ?></h3>
		<h3>date of rental: <?php echo $row['date_of_rental']; ?></h3>
		<h3>carmodel: <?php echo $row['car_model']; ?></h3>
		<h3>expected return: <?php echo $row['expected_return']; ?></h3>
		<h3>added by: <?php echo $row['added_by']; ?></h3>
		<h3>updated by: <?php echo $row['last_updated_by']; ?></h3>
		<h3>last updated: <?php echo $row['last_updated']?></h3>

		<div class="editAndDelete" style="float: right; margin-right: 20px;">
			<a href="viewprojects.php?rental_id=<?php echo $row['rental_id']; ?>">View clients</a>
			<a href="editwebdev.php?rental_id=<?php echo $row['rental_id']; ?>">Edit</a>
			<a href="deletewebdev.php?rental_id=<?php echo $row['rental_id']; ?>">Delete</a>

		</div>
		
	</div> 
	<?php } ?>
</body>
</html>
