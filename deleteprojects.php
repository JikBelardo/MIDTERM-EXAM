<?php require_once 'core\core.php'; ?>
<?php require_once 'core\models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="deleteprojects.css">
</head>
<body>
	<?php $getProjectByID = getProjectByID($pdo, $_GET['client_id']); ?>
	<h1>Are you sure you want to delete this project?</h1>
	<div class="container" style="border-style: solid; height: 400px;">
		<h2>first name: <?php echo $getProjectByID['firstname'] ?></h2>
		<h2>last name: <?php echo $getProjectByID['lastname'] ?></h2>
		<h2>car rented: <?php echo $getProjectByID['car_rented'] ?></h2>
		<h2>Date Added: <?php echo $getProjectByID['date_added'] ?></h2>

		<div class="deleteBtn" style="float: right; margin-right: 10px;">

			<form action="core\handleforms.php?client_id=<?php echo $_GET['client_id']; ?>&rental_id=<?php echo $_GET['client_id']; ?>" method="POST">
				<input type="submit" name="deleteProjectBtn" value="Delete">
			</form>			
			
		</div>	

	</div>
</body>
</html>