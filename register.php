<?php

/*
 * Following code will create a new product row
 * All product details are read from HTTP Post Request
*/
 
// connecting to db
include_once 'initialize.php';

// array for JSON response
$response = array();
 
// check for required fields
if (isset($_POST['newLogin']) && isset($_POST['newPassword']) && isset($_POST['newName'])) {
 
	$newLogin = trim($_POST['newLogin']);
	$newPassword = md5(trim($_POST['newPassword']));
	$newName = trim($_POST['newName']);
		
	$query = 'SELECT idUsuario FROM hsemh.usuario WHERE dscEmailUsuario=:username AND senhaUsuario=:password';
	
	//prepare statement
	$stmt = $db->prepare($query);
	
	//binding of parameters
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);

	$stmt->execute();

	$result = $stmt->fetch(PDO::FETCH_ASSOC);

	// check for empty result
	if ($result) {
		$response["success"] = 0;
		$response["error"] = "usuario ja cadastrado";
	}
	else {
		//$result = pg_query($con, "INSERT INTO usuarios(login, password) VALUES('$newLogin', '$newPassword')");
		$query = 'INSERT into hsemh.usuario (nomusuario, dscemailusuario, senhausuario, dscbiousuario, linkfotousuario)
		values(:nomusuario, :dscemailusuario, :senhausuario, NULL, NULL)';
		
		//prepare statement
		$stmt = $db->prepare($query);

		//binding of parameters
		$stmt->bindParam(':nomusuario', $newName);
		$stmt->bindParam(':dscemailusuario', $newLogin);
		$stmt->bindParam(':senhausuario', $newPassword);

		if ($stmt->execute()) {
			$response["success"] = 1;
		}
		else {
			$response["success"] = 0;
			$response["error"] = "Error BD: ". $stmt->error;
		}
	}
}
else {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}

echo json_encode($response);
?>