<?php

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$classificacao = new Classificacao($db);

//Verifica se existe o id passado por parâmetro
$classificacao->id = isset($_GET['id']) ? $_GET['id'] : die();

if ($classificacao->get()) {
	$post_item = array(
		'idclassificacao' => $classificacao->id,
		'dscclassificacao' =>  html_entity_decode($classificacao->dsc),
		'success' => 1
	);

	print_r(json_encode($post_item));
} else {
	
	print_r(json_encode(array (
		"message" => "Classificacao not found",
		'success' => 0
	)));
}
?>