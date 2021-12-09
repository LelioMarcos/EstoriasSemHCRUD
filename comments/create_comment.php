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
$post = new Comment($db);

$post->comment = isset($_POST['comment']) ? $_POST['comment'] : die();
$post->idusuario = isset($_POST['idusuario']) ? $_POST['idusuario'] : die();
$post->idhist = isset($_POST['idhist']) ? $_POST['idhist'] : die();

//Chamada ao método create
if($post->create()){
	echo json_encode(
		array('message' => 'Post created.')
	);
}else{
	echo json_encode(
		array('message' => 'Post not created.')
	);
}
?>