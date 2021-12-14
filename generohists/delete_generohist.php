<?php
//headers - comando que especifica características da resgenerohista do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

$generohist = new GeneroHist($db);

$generohist->id = isset($_POST['id']) ? $_POST['id'] : die();

//create generohist
if($generohist->delete()){
	header(http_response_code(200));
	echo json_encode(
		array('message' => 'GeneroHist deleted.')
	);
} else {
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'GeneroHist not deleted.')
	);
}
?>