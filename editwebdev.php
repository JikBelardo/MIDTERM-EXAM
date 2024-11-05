
<?php require_once 'core\handleforms.php'; ?>
<?php require_once 'core\models.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Document</title>
	<link rel="stylesheet" href="editwebdev.css">
</head>
<body>
	<?php $getWebDevByID = getWebDevByID($pdo, $_GET['rental_id']); ?>
	<h1>Edit the user!</h1>
	<form action="core\handleforms.php?rental_id=<?php echo $_GET['rental_id']; ?>" method="POST">
		<p>
			<label for="firstname">first name</label> 
			<input type="text" name="firstname" value="<?php echo $getWebDevByID['first_name']; ?>">
		</p>
		<p>
			<label for="lastname">Last name</label> 
			<input type="text" name="lastname" value="<?php echo $getWebDevByID['last_name']; ?>">
		</p>
		<p>
			<label for="carmanufacturer">car manufacturer</label> 
			<input type="text" name="carmanufacturer" value="<?php echo $getWebDevByID['car_manufacturer']; ?>">
		</p>
		<p>
			<label for="date of rental">cate of rental</label> 
			<input type="date" name="dateofrental" value="<?php echo $getWebDevByID['date_of_rental']; ?>">
		</p>
        <p>
			<label for="carmanufacturer">car model</label> 
			<input type="text" name="carmodel" value="<?php echo $getWebDevByID['car_model']; ?>">
		</p>
        <p>
			<label for="expectedreturn">expected return</label> 
			<input type="text" name="expectedreturn" value="<?php echo $getWebDevByID['expected_return']; ?>">
            <input type="submit" name="editWebDevBtn">
		</p>
	</form>
</body>
</html>
