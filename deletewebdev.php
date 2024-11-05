<?php require_once 'core\models.php'; ?>
<?php require_once 'core\core.php'; ?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="deletewebdev.css">
</head>
<body>
	<h1>Are you sure you want to delete this user?</h1>
	<?php $getWebDevByID = getWebDevByID($pdo, $_GET['rental_id']); ?>
    <?php if ($getWebDevByID): ?>
    <h2>FirstName: <?php echo $getWebDevByID['first_name']; ?></h2>
    <h2>LastName: <?php echo $getWebDevByID['last_name']; ?></h2>
    <h2>manufactuer: <?php echo $getWebDevByID['car_manufacturer']; ?></h2>
    <h2>date of rental: <?php echo $getWebDevByID['date_of_rental']; ?></h2>
    <h2>car model: <?php echo $getWebDevByID['car_model']; ?></h2>
    <h2>expected return: <?php echo $getWebDevByID['expected_return']; ?></h2>
    <?php else: ?>
    <h2>No record found for this rental ID.</h2>
    <?php endif; ?>
    <div class="deleteBtn" style="float: right; margin-right: 10px;">
			<form action="core\handleforms.php?rental_id=<?php echo $_GET['rental_id']; ?>" method="POST">
				<input type="submit" name="deleteWebDevBtn" value="Delete">
			</form>			
		</div>	
</body>
</html>