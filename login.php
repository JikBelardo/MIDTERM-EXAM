<?php  
require_once 'core/models.php'; 
require_once 'core/handleforms.php'; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="styles.css">
	<title>Document</title>
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
    <div class="container">
        <?php if (isset($_SESSION['message'])) { ?>
            <div id="message"><?php echo $_SESSION['message']; ?></div>
        <?php } unset($_SESSION['message']); ?>
        
        <div id="login"><h1>Login Now!</h1></div>
        
        <form action="core/handleforms.php" method="POST">
            <p>
                <label for="username">Username</label>
                <input type="text" name="username">
            </p>
            <p>
                <label for="password">Password</label>
                <input type="password" name="password">
                <input type="submit" name="loginUserBtn" value="Submit">
            </p>
        </form>
        
        <p>Don't have an account? You may register <a href="register.php">here</a></p>
    </div>
</body>

</html>