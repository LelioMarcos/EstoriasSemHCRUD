<?php
//headers - comando que especifica características da resgenerohista do cabeçalho HTTP.

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
$generohist = new GeneroHist($db);

$generohist->idhist = isset($_POST['id_story']) ? $_POST['id_story'] : die();
$generohist->idgenero = isset($_POST['id_genero']) ? $_POST['id_genero'] : die();

//Chamada ao método create
if($generohist->create_id()){
	echo json_encode(
		array('message' => 'GeneroHist created.')
	);
}else{
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'GeneroHist not created.')
	);
}
?>