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
$post = new User($db);

$post->nome = isset($_POST['nome']) ? $_POST['nome'] : die();
$post->email = isset($_POST['email']) ? $_POST['email'] : die();
$post->senha = isset($_POST['senha']) ? $_POST['senha'] : die();
$post->bio = isset($_POST['bio']) ? $_POST['bio'] : die();
$post->foto = isset($_POST['foto']) ? $_POST['foto'] : die();

//Chamada ao método create
if($post->create()){
	echo json_encode(
		array('message' => 'User created.')
	);
}else{
	echo json_encode(
		array('message' => 'User not created.')
	);
}
?>