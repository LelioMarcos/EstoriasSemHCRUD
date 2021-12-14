<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$stora = new Story($db);

//Verifica se existe o id passado por parâmetro
$stora->id = isset($_GET['id']) ? $_GET['id'] : die();


if ($stora->get()) {
	$cover = new Cover($db);
	$cover->id = $stora->capa;
	
	if ($cover->get()) {
		$post_item = array(
			'idhist' => $stora->id,
			'nomhist' => html_entity_decode($stora->titulo),
			'dscsinopsehist' => html_entity_decode($stora->sinopse),
			'dsccorpohist' => html_entity_decode($stora->corpo),
			'linkcapa' => $cover->link			
		);
		//imprime o JSON
		print_r(json_encode($post_item));
	} else {
		header(http_response_code(404));
		print_r(json_encode(array (
			"message" => "Cover not found"
		)));
	}
} else {
	header(http_response_code(404));
	print_r(json_encode(array (
		"message" => "Story not found"
	)));
}
?>