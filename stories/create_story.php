<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.
//incializa banco de dados e método story
include_once('../initialize.php'); 
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: POST');
//Instancia objeto story com a conexão com o banco de dados
$story = new Story($db);

$story->titulo = isset($_POST['titulo']) ? trim($_POST['titulo']) : die();
$story->sinopse = isset($_POST['sinopse']) ? trim($_POST['sinopse']) : die();
$story->corpo = isset($_POST['corpo']) ? trim($_POST['corpo']) : die();
$story->idusuario = isset($_POST['idusuario']) ? trim($_POST['idusuario']) : die();
//$story->classificacao = isset($_POST['idclassificacao']) ? trim($_POST['idclassificacao']) : die();
$story->idcapa = isset($_POST['idcapa']) ? trim($_POST['idcapa']) : die();

//Chamada ao método create
if($story->create()) {
	echo json_encode(
		array('message' => 'Story created.',
		'id' => $story->id)
	);
}else{
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'Story not created.')
	);
}
?>