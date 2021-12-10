<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$user = new User($db);

//Verifica se existe o id passado por parâmetro
$user->id = isset($_GET['id']) ? $_GET['id'] : die();
$user->read_single();

//monta o array que será retornado.
$post_item = array(
	'idusuario' => $user->id,
    'nomusuario' => html_entity_decode($user->nome),
    'dscemailusuario' => html_entity_decode($user->email),
    'senhausuario' => html_entity_decode($user->senha),
    'dscbiousuario' => html_entity_decode($user->bio),
    'linkfotousuario' => html_entity_decode($user->foto)				
);

//imprime o JSON
print_r(json_encode($post_item));
?>