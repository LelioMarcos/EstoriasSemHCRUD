<?php
//headers - comando que especifica características da rescovera do cabeçalho HTTP.

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
$cover = new Cover($db);

$cover->link = isset($_POST['link']) ? $_POST['link'] : die();

//Chamada ao método create
if($cover->create()){
	header(http_response_code(201));
	echo json_encode(
		array('message' => 'Cover created.')
	);
}else{
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'Cover not created.')
	);
}
?>