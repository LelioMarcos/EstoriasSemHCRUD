<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
header('Access-Control-Allow-Methods: PUT');

//Especificando os headers permitindos na requisição
header('Access-Control-Allow-Headers: Access-Control-Allow-Headers,Content-Type,Access-Control-Allow-Methods,Authorization,X-Requested-With');

//incializa banco de dados e método requisição
include_once('../initialize.php'); 

//Instancia objeto story com a conexão com o banco de dados
$story = new Story($db);

$story->id = isset($_POST['id']) ? $_POST['id'] : die();
$story->titulo = isset($_POST['titulo']) ? $_POST['titulo'] : die();
$story->sinopse = isset($_POST['sinopse']) ? $_POST['sinopse'] : die();
$story->corpo = isset($_POST['corpo']) ? $_POST['corpo'] : die();
$story->nota = isset($_POST['nota']) ? $_POST['nota'] : die();
$story->idcapa = isset($_POST['idcapa']) ? $_POST['idcapa'] : die();

//create story
if($story->update()){
	echo json_encode (
		array('message' => 'Story updated.')
	);
}else{
	echo json_encode(
		array('message' => 'Story not updated.')
	);
}
?>