<?php
//headers - comando que especifica características da resgenerohista do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

//Instancia objeto generohist com a conexão com o banco de dados
$generohist = new GeneroHist($db);

$generohist->id = isset($_POST['id']) ? $_POST['id'] : die();
$generohist->idhist = isset($_POST['id_story']) ? $_POST['id_story'] : die();
$generohist->idgenero = isset($_POST['id_genero']) ? $_POST['id_genero'] : die();

//create generohist
if($generohist->update()){
	echo json_encode (
		array('message' => 'GeneroHist updated.')
	);
} else {
	echo json_encode(
		array('message' => 'GeneroHist not updated.')
	);
}
?>