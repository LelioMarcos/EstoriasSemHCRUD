<?php
//headers - comando que especifica características da resrespostaa do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

$resposta = new Resposta($db);

$resposta->id = isset($_POST['id']) ? $_POST['id'] : die();

//create resposta
if($resposta->delete()){
	echo json_encode(
		array('message' => 'Resposta deleted.')
	);
} else {
	echo json_encode(
		array('message' => 'Resposta not deleted.')
	);
}
?>