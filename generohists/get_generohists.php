<?php
//headers - comando que especifica características da resgenerohista do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
//incializa banco de dados e método generohist
include_once('../initialize.php');

//Instancia objeto generohist com a conexão com o banco de dados
$generohist = new GeneroHist($db);

$result = array();

if (isset($_GET['id_hist'])) {
	$generohist->idhist = $_GET['id_hist'];
	$result = $generohist->get_from_story();
} else {
	$result = $generohist->get_all();
}

if ($result->rowCount() > 0){
	$generohist_arr = array();
	$generohist_arr['data'] = array();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$generohist_item = array(
			'idgenerohist' => $row['idgenerohist'],
			'idgenero' => html_entity_decode($row['fk_genero_idgenero']),
			'idhist' => html_entity_decode($row['fk_historia_idhist']),
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($generohist_arr['data'],$generohist_item);
	}
	//Converte para JSON a saída
	echo json_encode($generohist_arr);
}else{
	header(http_response_code(404));
	echo json_encode(array('message' => 'No generohist found.'));
}
?>