<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$resposta = new Resposta($db);

//Chamada ao método read da classe POST
$result = $resposta->get_all();

//Obtém a quantidade de linhas
$num = $result->rowCount();

if ($num > 0){
	$resposta_arr = array();
	$resposta_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		//extrai dados do array
		extract($row);
		$resposta_item = array(
			'idresposta' => $row['idresposta'],
			'idComentResp' => html_entity_decode($row['idComentResp']),
            'idComent' => html_entity_decode($row['idcoment']),
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($resposta_arr['data'],$resposta_item);
	}
	//Converte para JSON a saída
	$resposta_arr['success'] = 1;
	echo json_encode($resposta_arr);
	
}else{
    
	echo json_encode(array('message' => 'No respostas found.', "success" => 0));
}
?>