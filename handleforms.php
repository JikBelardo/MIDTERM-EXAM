
<?php 

require_once 'core.php'; 
require_once 'models.php';



if (isset($_POST['Btninsert'])) {
	$firstname = trim($_POST['firstname']);
	$lastname = trim($_POST['lastname']);
	$carmanufacturer = trim($_POST['carmanufacturer']);
	$dateofrental = trim($_POST['dateofrental']);
	$carmodel = trim($_POST['carmodel']);
	$expectedreturn = trim($_POST['expectedreturn']);
	$added_by = $_SESSION['username'];

	if (!empty($firstname) && !empty($lastname) && !empty($carmanufacturer) && !empty($dateofrental) && !empty($carmodel)   && !empty($expectedreturn)) {
			$query = insertIntoRecords($pdo, $firstname, $lastname, $carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $added_by);

		if ($query) {
			header('Location: ../sqsample.php');
        exit();
		}

		else {
			echo "Insertion failed";
		}
	}

	else {
		echo "Make sure that no fields are empty";
	}
	
}

if (isset($_POST['editWebDevBtn'])) {
	$query = updateWebDev($pdo, $_POST['firstname'], $_POST['lastname'], 
		$_POST['carmanufacturer'], $_POST['dateofrental'], $_POST['carmodel'], $_POST['expectedreturn'], $_SESSION['username'], $_GET['rental_id']);

	if ($query) {
		header("Location: ../sqsample.php");
	}

	else {
		echo "Edit failed";;
	}

}

if (isset($_POST['deleteWebDevBtn'])) {
	$query = deleteWebDev($pdo, $_GET['rental_id']);

	if ($query) {
		header("Location: ../sqsample.php");
	}

	else {
		echo "Deletion failed";
	}
}

if (isset($_POST['insertNewProjectBtn'])) {
    $firstname = trim($_POST['first_name']);
    $lastname = trim($_POST['last_name']);
	$added_by = $_SESSION['username'];

    if (!empty($firstname) && !empty($lastname)) {
        $query = insertProject($pdo, $firstname, $lastname, $added_by, $_GET['rental_id']);
        if ($query) {
            header('Location: ../viewprojects.php?rental_id=' . $_GET['rental_id']);
            exit();
        } else {
            echo "Insertion failed";
        }
    } else {
        echo "Please fill in all fields.";
    }
}


if (isset($_POST['editProjectBtn'])) {
	$added_by = $_SESSION['username'];
	$query = updateProject($pdo, $_POST['firstname'], $_POST['lastname'], $added_by, $_GET['client_id'], );

	if ($query) {
		header("Location: ../viewprojects.php?rental_id=" .$_GET['rental_id']);
	}
	else {
		echo "Update failed";
	}

}

if (isset($_POST['deleteProjectBtn'])) {
	$query = deleteProject($pdo, $_GET['client_id']);

	if ($query) {
		header("Location: ../viewprojects.php?rental_id=" .$_GET['rental_id']);
	}
	else {
		echo "Deletion failed";
	}
}


if (isset($_POST['registerUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$insertQuery = insertNewUser($pdo, $username, $password);

		if ($insertQuery) {
			header("Location: ../login.php");
		}
		else {
			header("Location: ../register.php");
		}
	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for registration!";

		header("Location: ../login.php");
	}

}


if (isset($_POST['loginUserBtn'])) {

	$username = $_POST['username'];
	$password = sha1($_POST['password']);

	if (!empty($username) && !empty($password)) {

		$loginQuery = loginUser($pdo, $username, $password);
	
		if ($loginQuery) {
			header("Location: ../sqsample.php");
		}
		else {
			header("Location: ../login.php");
		}

	}

	else {
		$_SESSION['message'] = "Please make sure the input fields 
		are not empty for the login!";
		header("Location: ../login.php");
	}
 
}



if (isset($_GET['logoutAUser'])) {
	unset($_SESSION['username']);
	header('Location: ../login.php');
}


?>
