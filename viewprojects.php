
<?php require_once 'core\core.php'; ?>
<?php require_once 'core\models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="viewprojects.css">
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
		}
	</style>
</head>
<body>
	<a href="sqsample.php">Return to home</a>
	<?php
	// Check if rental_id is set
	if (isset($_GET['rental_id'])) {
	    $rental_id = $_GET['rental_id'];
	} else {
	    // Handle the absence of rental_id
	    echo "<p>Error: rental_id is not specified.</p>";
	    exit; // Stop further execution
	}
	
	?>
	?>
	<form action="core\handleforms.php?rental_id=<?php echo $rental_id; ?>" method="POST">
   <p>
      <label for="firstname">First Name</label> 
      <input type="text" name="first_name">
   </p>
   <p>
      <label for="lastname">Last Name</label> 
      <input type="text" name="last_name">
      <input type="submit" name="insertNewProjectBtn" value="Submit">
   </p>
	</form>


	<table style="width:100%; margin-top: 50px;">
	  <tr>
	    <th>client ID</th>
	    <th>first name</th>
	    <th>last name</th>
	    <th>car rented</th>
	    <th>Date Added</th>
		<th>added by</th>
		<th>updated by</th>
		<th>last updated</th>
	    <th>Action</th>
	  </tr>
	  <?php $rental_id = $_GET['rental_id'];?>
	  <?php $getProjectsByWebDev = getProjectsByWebDev($pdo, $_GET['rental_id']); ?>
	  <?php foreach ($getProjectsByWebDev as $row) { ?>
	  <tr>
	  	<td><?php echo $row['client_id']; ?></td>	  	
	  	<td><?php echo $row['firstname']; ?></td>	  	
	  	<td><?php echo $row['lastname']; ?></td>	  	
	  	<td><?php echo $row['car_rented']; ?></td>	  	
	  	<td><?php echo $row['date_added']; ?></td>
		<td><?php echo $row['added_by']; ?></td>
		<td><?php echo $row['updated_by']; ?></td>
		<td><?php echo $row['last_updated']; ?></td>
	  	<td>
	  		<a href="editprojects.php?client_id=<?php echo $row['client_id']; ?>&rental_id=<?php echo $_GET['rental_id']; ?>">Edit</a>

	  		<a href="deleteprojects.php?client_id=<?php echo $row['client_id']; ?>&rental_id=<?php echo $_GET['rental_id']; ?>">Delete</a>
	  	</td>	  	
	  </tr>
	<?php } ?>
	</table>


</body>
</html>
