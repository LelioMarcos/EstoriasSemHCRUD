<?php

include_once 'initialize.php';

// array for JSON response
$response = array();

$username = NULL;
$password = NULL;

// Método para mod_php (Apache)
if ( isset( $_SERVER['PHP_AUTH_USER'] ) ) {
    $username = $_SERVER['PHP_AUTH_USER'];
    $password = $_SERVER['PHP_AUTH_PW'];
}
// Método para demais servers
elseif(isset( $_SERVER['HTTP_AUTHORIZATION'])) {
    if(preg_match( '/^basic/i', $_SERVER['HTTP_AUTHORIZATION']))
		list($username, $password) = explode(':', base64_decode(substr($_SERVER['HTTP_AUTHORIZATION'], 6)));
}

// Se a autenticação não foi enviada
if(is_null($username)) {
    $response["success"] = 0;
	$response["error"] = "faltam parametros";
}
// Se houve envio dos dados
else {
	// Instancia objeto Usuario com a conexão com o banco de dados
	$password = md5($password);

	$query = 'SELECT idUsuario FROM hsemh.usuario WHERE dscEmailUsuario=:username AND senhaUsuario=:password';
	
	//prepare statement
	$stmt = $db->prepare($query);
	
	//binding of parameters
	$stmt->bindParam(':username', $username);
	$stmt->bindParam(':password', $password);
	
	//execute the query
	if ($stmt->execute()) {
		$result = $stmt->fetch(PDO::FETCH_ASSOC);
		
		if ($result) {	
			$response["success"] = 1;
			$response["idUsuario"] = $result["idusuario"];
		} else {
			$response["success"] = 0;
			$response["error"] = "usuario ou senha não confere";
		}
	} else {
		$response["success"] = 0;
		$response["error"] = "Erro ao executar a query";
	}
}

echo json_encode($response);
?>