<?php
//headers - comando que especifica características da rescommenta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

//Instancia objeto comment com a conexão com o banco de dados
$comment = new Comment($db);

$comment->id = isset($_POST['id']) ? $_POST['id'] : die();
$comment->comment = isset($_POST['corpo']) ? $_POST['corpo'] : die();

//create comment
if($comment->update()){
	echo json_encode (
		array('message' => 'Comment updated.')
	);
} else {
	echo json_encode(
		array('message' => 'Comment not updated.')
	);
}
?>