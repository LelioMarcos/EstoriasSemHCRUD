<?php
//headers - comando que especifica características da resclassificacaoa do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');
//incializa banco de dados e método classificacao
include_once('../initialize.php');

//Instancia objeto classificacao com a conexão com o banco de dados
$classificacao = new Classificacao($db);

$result = $classificacao->get_all();

if ($result->rowCount() > 0){
	$classificacao_arr = array();
	$classificacao_arr['data'] = array();
	
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		extract($row);

		$classificacao_item = array(
			'idclassificacao' => $row['idclassificacao'],
			'dscclassificacao' => html_entity_decode($row['dscclassificacao']),
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($classificacao_arr['data'],$classificacao_item);
	}
	//Converte para JSON a saída
	$classificacao_arr['success'] = 1;
	echo json_encode($classificacao_arr);
}else{
	
	echo json_encode(array('message' => 'No classificacaos found.', 'success' => 0));
}
?>