<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
//incializa banco de dados e método POST
include_once('../initialize.php');

//Instancia objeto Post com a conexão com o banco de dados
$stora = new Story($db);

$result = array();

if (isset($_GET['id_user'])) {
	$stora->idusuario = $_GET['id_user'];
	$result = $stora->get_from_user();
} else {
	$result = $stora->get_all();
}

if ($result->rowCount() > 0){
	$post_arr = array();
	$post_arr['data'] = array();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$post_item = array(
			'idhist' => $row['idhist'],
			'nomhist' => html_entity_decode($row['nomhist']),
			'dscsinopsehist' => html_entity_decode($row['dscsinopsehist']),
			'dsccorpohist' => html_entity_decode($row['dsccorpohist']),
			'idcapa' => html_entity_decode($row['idcapa']),
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($post_arr['data'],$post_item);
	}
	//Converte para JSON a saída
	echo json_encode($post_arr);
}else{
	header(http_response_code(404));
	echo json_encode(array('message' => 'No posts found.'));
}
?>