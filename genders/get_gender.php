<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$gender = new Gender($db);

//Verifica se existe o id passado por parâmetro
$gender->id = isset($_GET['id']) ? $_GET['id'] : die();
$gender->get();

//monta o array que será retornado.
$post_item = array(
	'idgenero' => $gender->id,
    'dscgenero' => html_entity_decode($gender->dsc),					
);

//imprime o JSON
print_r(json_encode($post_item));
?>