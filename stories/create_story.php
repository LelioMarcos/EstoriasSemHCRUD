<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.
//incializa banco de dados e método story
include_once('../initialize.php'); 

//Instancia objeto story com a conexão com o banco de dados
$story = new Story($db);

$story->titulo = isset($_POST['titulo']) ? $_POST['titulo'] : die();
$story->sinopse = isset($_POST['sinopse']) ? $_POST['sinopse'] : die();
$story->corpo = isset($_POST['corpo']) ? $_POST['corpo'] : die();
$story->idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : die();
$story->idcapa = isset($_POST['idcapa']) ? $_POST['idcapa'] : die();

echo $_POST['titulo'];
/*
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
?>*/