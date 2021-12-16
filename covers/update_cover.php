<?php
//headers - comando que especifica características da rescovera do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

//Instancia objeto cover com a conexão com o banco de dados
$cover = new Cover($db);

$cover->id = isset($_POST['id']) ? $_POST['id'] : die();
$cover->link = isset($_POST['link']) ? $_POST['link'] : die();

//create cover
if($cover->update()){
	echo json_encode (
		array('message' => 'Cover updated.')
	);
} else {
	echo json_encode(
		array('message' => 'Cover not updated.')
	);
}
?>