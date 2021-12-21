<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$story = new Story($db);

//Verifica se existe o id passado por parâmetro
$story->id = isset($_GET['id']) ? $_GET['id'] : die();


if ($story->get()) {
	$user = new User($db);
	$user->id = $story->idusuario;
	$user->get();

	$story_item = array(
		'idhist' => $story->id,
		'nomhist' => html_entity_decode($story->titulo),
		'dscsinopsehist' => html_entity_decode($story->sinopse),
		'notahist' => $story->nota,
		'dsccorpohist' => html_entity_decode($story->corpo),
		'idusuario' => $story->idusuario,
		'nome' => $user->nome,
		'idcapa' => $story->capa			
	);
	//imprime o JSON
	$story_item['success'] = 1;
	print_r(json_encode($story_item));
} else {
	header(http_response_code(404));
	print_r(json_encode(array (
		"message" => "Story not found",
		"success" => 0
	)));
}
?>