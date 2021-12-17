<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método story
include_once('../initialize.php'); 

//Instancia objeto story com a conexão com o banco de dados
$story = new Story($db);

if (isset($_POST['titulo']) && isset($_POST['sinopse']) && isset($_POST['corpo']) && isset($_POST['idusuario']) && isset($_POST['idcapa'])) {
	$story->titulo = isset($_POST['titulo']) ? $_POST['titulo'] : die();
	$story->sinopse = isset($_POST['sinopse']) ? $_POST['sinopse'] : die();
	$story->corpo = isset($_POST['corpo']) ? $_POST['corpo'] : die();
	$story->idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : die();
	$story->idcapa = isset($_POST['idcapa']) ? $_POST['idcapa'] : die();

	//Chamada ao método create
	if($story->create()){
		header(http_response_code(201));
		echo json_encode(
			array('message' => 'Story created.')
		);
	}else{
		header(http_response_code(500));
		echo json_encode(
			array('message' => 'Story not created.')
		);
	}
} else {
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'Story not created.')
	);
}
?>