<?php
//headers - comando que especifica características da resclassificacaoa do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: DELETE');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

$classificacao = new Classificacao($db);

$classificacao->id = isset($_POST['id']) ? $_POST['id'] : die();

//create classificacao
if($classificacao->delete()){
	echo json_encode(
		array('message' => 'Classificacao deleted.')
	);
} else {
	echo json_encode(
		array('message' => 'Classificacao not deleted.')
	);
}
?>