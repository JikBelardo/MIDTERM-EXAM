<?php  

function insertIntoRecords($pdo, $firstname, $lastname, 
$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $added_by) {

	$sql = "INSERT INTO car_rental (first_name, last_name, 
		car_manufacturer, date_of_rental, car_model, expected_return, added_by, last_updated) VALUES(?,?,?,?,?,?,?,NOW())";

	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstname, $lastname, 
		$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $added_by]);

	if ($executeQuery) {
		return true;
	}
}



function updateWebDev($pdo, $firstname, $lastname, 
$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $rental_id, $last_updated_by) {

	$sql = "UPDATE car_rental
				SET first_name = ?,
					last_name = ?,
					car_manufacturer = ?, 
					date_of_rental = ?,
					car_model = ?,
					expected_return = ?,
					last_updated = NOW(),
					last_updated_by = ?
				WHERE rental_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$firstname, $lastname, 
	$carmanufacturer, $dateofrental, $carmodel, $expectedreturn, $rental_id, $last_updated_by]);
	
	if ($executeQuery) {
		return true;
	}

}


function deleteWebDev($pdo, $rental_id) {
	$deleteWebDevProj = "DELETE FROM car_rental WHERE rental_id = ?";
	$deleteStmt = $pdo->prepare($deleteWebDevProj);
	$executeDeleteQuery = $deleteStmt->execute([$rental_id]);

	if ($executeDeleteQuery) {
		$sql = "DELETE FROM car_rental WHERE rental_id = ?";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$rental_id]);

		if ($executeQuery) {
			return true;
		}

	}
	
}




function getAllWebDevs($pdo) {
	$sql = "SELECT * FROM car_rental";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}
}

function getWebDevByID($pdo, $rental_id) {
	$sql = "SELECT * FROM car_rental WHERE rental_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);

	if ($executeQuery) {
		return $stmt->fetch();
	}
}



function getProjectsByWebDev($pdo, $rental_id) {
    $sql = "SELECT 
                clients.client_id AS client_id,
                clients.client_first_name AS firstname,
                clients.client_last_name AS lastname,
                CONCAT(car_rental.car_manufacturer, ' ', car_rental.car_model) AS car_rented,
                clients.date_added AS date_added,
				clients.added_by,
				clients.updated_by,
				clients.last_updated
            FROM clients
            JOIN car_rental ON clients.rental_id = car_rental.rental_id
            WHERE car_rental.rental_id = ? 
            GROUP BY clients.client_id;";
    
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$rental_id]);
    if ($executeQuery) {
        return $stmt->fetchAll();
    }
}



function insertProject($pdo, $firstname, $lastname, $added_by, $rental_id ) {
    $sql = "INSERT INTO clients (client_first_name, client_last_name,added_by, rental_id, date_added) VALUES (?,?,?,?,CURDATE())";
    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$firstname, $lastname, $added_by, $rental_id]);
    
    if ($executeQuery) {
        return true;
    }
    return false;
}



function getProjectByID($pdo, $client_id) {
    $sql = "SELECT 
                clients.client_id AS client_id,
                clients.client_first_name AS firstname,
                clients.client_last_name AS lastname,
                CONCAT(car_rental.car_manufacturer,' ',car_rental.car_model) AS car_rented,
                clients.date_added AS date_added,
				clients.added_by,
				clients.updated_by,
				clients.last_updated
            FROM clients
            JOIN car_rental ON clients.rental_id = car_rental.rental_id
            WHERE clients.client_id = ?
			GROUP BY clients.client_id;";


    $stmt = $pdo->prepare($sql);
    $executeQuery = $stmt->execute([$client_id]);
    if ($executeQuery) {
        return $stmt->fetch();
    }
}


function updateProject($pdo, $client_first_name, $client_last_name,$updated_by, $client_id) {
	$sql = "UPDATE clients
			SET client_first_name = ?,
				client_last_name = ?,
				updated_by = ?,
				last_updated = NOW()
			WHERE client_id = ?
			";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_first_name, $client_last_name, $updated_by, $client_id]);

	if ($executeQuery) {
		return true;
	}
}

function deleteProject($pdo, $client_id) {
	$sql = "DELETE FROM clients WHERE client_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$client_id]);
	if ($executeQuery) {
		return true;
	}
}

function getAllInfoByWebDevID($pdo, $rental_id ) {
	$sql = "SELECT * FROM car_rental WHERE rental_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$rental_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}

function insertNewUser($pdo, $username, $password) {

	$checkUserSql = "SELECT * FROM user_passwords WHERE username = ?";
	$checkUserSqlStmt = $pdo->prepare($checkUserSql);
	$checkUserSqlStmt->execute([$username]);

	if ($checkUserSqlStmt->rowCount() == 0) {

		$sql = "INSERT INTO user_passwords (username,password) VALUES(?,?)";
		$stmt = $pdo->prepare($sql);
		$executeQuery = $stmt->execute([$username, $password]);

		if ($executeQuery) {
			$_SESSION['message'] = "User successfully inserted";
			return true;
		}

		else {
			$_SESSION['message'] = "An error occured from the query";
		}

	}
	else {
		$_SESSION['message'] = "User already exists";
	}

	
}

function loginUser($pdo, $username, $password) {
	$sql = "SELECT * FROM user_passwords WHERE username=?";
	$stmt = $pdo->prepare($sql);
	$stmt->execute([$username]); 

	if ($stmt->rowCount() == 1) {
		$userInfoRow = $stmt->fetch();
		$usernameFromDB = $userInfoRow['username']; 
		$passwordFromDB = $userInfoRow['password'];

		if ($password == $passwordFromDB) {
			$_SESSION['username'] = $usernameFromDB;
			$_SESSION['message'] = "Login successful!";
			return true;
		}

		else {
			$_SESSION['message'] = "Password is invalid, but user exists";
		}
	}

	
	if ($stmt->rowCount() == 0) {
		$_SESSION['message'] = "Username doesn't exist from the database. You may consider registration first";
	}

}

function getAllUsers($pdo) {
	$sql = "SELECT * FROM user_passwords";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute();

	if ($executeQuery) {
		return $stmt->fetchAll();
	}

}

function getUserByID($pdo, $user_id) {
	$sql = "SELECT * FROM user_passwords WHERE user_id = ?";
	$stmt = $pdo->prepare($sql);
	$executeQuery = $stmt->execute([$user_id]);
	if ($executeQuery) {
		return $stmt->fetch();
	}
}


?>