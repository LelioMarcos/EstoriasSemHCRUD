<?php
//headers - comando que especifica características da resstorya do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
//incializa banco de dados e método POST
include_once('../initialize.php');

//Instancia objeto Post com a conexão com o banco de dados
$story = new Story($db);

$result = array();

if (isset($_GET['id_user'])) {
	$story->idusuario = $_GET['id_user'];
	$result = $story->get_from_user();
} else if (isset($_GET['search'])) {
	$result = $story->search($_GET['search']);
} else {
	$result = $story->get_all();
}

if ($result->rowCount() > 0){
	$story_arr = array();
	$story_arr['data'] = array();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$story_item = array(
			'idhist' => $row['idhist'],
			'nomhist' => html_entity_decode($row['nomhist']),
			'dscsinopsehist' => html_entity_decode($row['dscsinopsehist']),
			'notahist' => $row['notahist'],
			'dsccorpohist' => html_entity_decode($row['dsccorpohist']),
			'idcapa' => $row['idcapa'],
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($story_arr['data'],$story_item);
	}

	$story_arr['success'] = 1;
	//Converte para JSON a saída
	echo json_encode($story_arr);
}else{
	header(http_response_code(404));
	echo json_encode(array('message' => 'No storys found.'));
}
?>