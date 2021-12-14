<?php
//headers - comando que especifica características da resclassificacaoa do cabeçalho HTTP.

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
$classificacao = new Classificacao($db);

$classificacao->dsc = isset($_POST['nome']) ? $_POST['nome'] : die();

//Chamada ao método create
if($classificacao->create()){
	echo json_encode(
		array('message' => 'Classificacao created.')
	);
}else{
	echo json_encode(
		array('message' => 'Classificacao not created.')
	);
}
?>