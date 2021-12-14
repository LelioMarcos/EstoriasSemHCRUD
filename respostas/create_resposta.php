<?php
//headers - comando que especifica características da resrespostaa do cabeçalho HTTP.

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
$resposta = new Resposta($db);

$resposta->id_coment_resp = isset($_POST['idcomentresp']) ? $_POST['idcomentresp'] : die();
$resposta->id_coment = isset($_POST['idcoment']) ? $_POST['idcoment'] : die();

//Chamada ao método create
if($resposta->create()){
	echo json_encode(
		array('message' => 'Resposta created.')
	);
}else{
	echo json_encode(
		array('message' => 'Resposta not created.')
	);
}
?>