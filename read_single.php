<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('initialize.php'); 

//Instanciando objeto
$post = new Post($db);

//Verifica se existe o id passado por parâmetro
$post-> id = isset($_GET['id']) ? $_GET['id'] : die();
$post -> read_single();

//monta o array que será retornado.
$post_arr= array(
	'id' => $post->id,
	'titulo' => $post->titulo
);

//imprime o JSON
print_r(json_encode($post_arr));


?>