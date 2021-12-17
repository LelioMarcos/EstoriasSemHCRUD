<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$post = new User($db);

$post->nome = isset($_POST['nome']) ? $_POST['nome'] : die();
$post->email = isset($_POST['email']) ? $_POST['email'] : die();
$post->senha = isset($_POST['senha']) ? $_POST['senha'] : die();
$post->bio = isset($_POST['bio']) ? $_POST['bio'] : die();
$post->foto = isset($_POST['foto']) ? $_POST['foto'] : die();

//Chamada ao método create
if($post->create()){
	header(http_response_code(201));
	echo json_encode(
		array('message' => 'User created.')
	);
}else{
	header("error");
	echo json_encode(
		array('message' => 'User not created.')
	);
}
?>