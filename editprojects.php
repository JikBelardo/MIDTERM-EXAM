<?php require_once 'core\models.php'; ?>
<?php require_once 'core\core.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Client</title>
    <link rel="stylesheet" href="editprojects.css">
</head>
<body>
    <a href="viewprojects.php?rental_id=<?php echo $_GET['rental_id']; ?>">
        View clients
    </a>
    <h1>Edit the client!</h1>
    <?php 
    $getProjectByID = getProjectByID($pdo, $_GET['client_id']); 
    if (!$getProjectByID) {
        echo "No client found with the given ID.";
        exit;
    }
    ?>
    <form action="core\handleforms.php?client_id=<?php echo $_GET['client_id']; ?>&rental_id=<?php echo $_GET['rental_id']; ?>" method="POST">
        <p>
            <label for="firstName">First Name</label> 
            <input type="text" name="firstname" value="<?php echo htmlspecialchars($getProjectByID['firstname']); ?>">
        </p>
        <p>
            <label for="lastName">Last Name</label> 
            <input type="text" name="lastname" value="<?php echo htmlspecialchars($getProjectByID['lastname']); ?>">
            <input type="submit" name="editProjectBtn" value="Update">
        </p>
    </form>
</body>
</html>