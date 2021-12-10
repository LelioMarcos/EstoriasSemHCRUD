<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: POST');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$post = new Story($db);

$post->titulo = isset($_POST['titulo']) ? $_POST['titulo'] : die();
$post->sinopse = isset($_POST['sinopse']) ? $_POST['sinopse'] : die();
$post->corpo = isset($_POST['corpo']) ? $_POST['corpo'] : die();
$post->idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : die();
$post->idcapa = isset($_POST['idcapa']) ? $_POST['idcapa'] : die();

//Chamada ao método create
if($post->create()){
	echo json_encode(
		array('message' => 'Story created.')
	);
}else{
	echo json_encode(
		array('message' => 'Story not created.')
	);
}
?>