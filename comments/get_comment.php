<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$comment = new Comment($db);

//Verifica se existe o id passado por parâmetro
$comment->id = isset($_GET['id']) ? $_GET['id'] : die();

if ($comment->get()) {
	$post_item = array(
		'idcoment' => $comment->id,
		'idusuario' => $comment->idusuario,
		'idhist' => $comment->idhist,
		'dsccorpocoment' => html_entity_decode($comment->comment),
		'nomusuario' => $comment->nomusuario,
		'success' => 1		
	);

//imprime o JSON
	print_r(json_encode($post_item));
} else {
	header(http_response_code(404));
	print_r(json_encode(array (
		"message" => "Comment not found",
		'success' => 0
	)));
}
?>