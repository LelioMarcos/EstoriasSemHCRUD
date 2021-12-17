<?php
//headers - comando que especifica características da resrespostaa do cabeçalho HTTP.

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$resposta = new Resposta($db);

$resposta->id_coment_resp = isset($_POST['idcomentresp']) ? $_POST['idcomentresp'] : die();
$resposta->id_coment = isset($_POST['idcoment']) ? $_POST['idcoment'] : die();

//Chamada ao método create
if($resposta->create()){
	header(http_response_code(201));
	echo json_encode(
		array('message' => 'Resposta created.')
	);
}else{
	header(http_response_code(500));
	echo json_encode(
		array('message' => 'Resposta not created.')
	);
}
?>