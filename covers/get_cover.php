<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$cover = new Cover($db);

//Verifica se existe o id passado por parâmetro
$cover->id = isset($_GET['id']) ? $_GET['id'] : die();


if ($cover->get()) {
	$post_item = array(
		'idcapa' => $cover->id,
		'linkcapa' => html_entity_decode($cover->link),
		'success' => 1	
	);
	//imprime o JSON
	print_r(json_encode($post_item));
} else {
	
	print_r(json_encode(array (
		"message" => "Cover not found",
		'success' => 0
	)));
}
?>