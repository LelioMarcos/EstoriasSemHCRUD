<?php
//headers - comando que especifica características da resgendera do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

//Instancia objeto gender com a conexão com o banco de dados
$gender = new Gender($db);

$gender->id = isset($_POST['id']) ? $_POST['id'] : die();
$gender->dsc = isset($_POST['nome']) ? $_POST['nome'] : die();

//create gender
if($gender->update()){
	echo json_encode (
		array('message' => 'Gender updated.')
	);
} else {
	echo json_encode(
		array('message' => 'Gender not updated.')
	);
}
?>