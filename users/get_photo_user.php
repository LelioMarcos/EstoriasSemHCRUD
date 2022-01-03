<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$user = new User($db);

//Verifica se existe o id passado por parâmetro
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if($user->get_photo()) {
    print_r($user->foto);
} else {
    header(http_response_code(404));
	print_r(json_encode(array (
		"message" => "User not found",
        "success" => 0
	)));
}
?>