<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$gender = new Gender($db);

//Chamada ao método read da classe POST
$result = $gender->get_all();

//Obtém a quantidade de linhas
$num = $result->rowCount();

if ($num > 0){
	$gender_arr = array();
	$gender_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		//extrai dados do array
		extract($row);
		$gender_item = array(
			'idgenero' => $row['idgenero'],
			'dscgenero' => html_entity_decode($row['dscgenero']),		
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($gender_arr['data'],$gender_item);
	}
	$gender_arr['success'] = 1;
	//Converte para JSON a saída
	echo json_encode($gender_arr);
	
}else{
	
	echo json_encode(array('message' => 'Gender not found.', 'success' => 0));
}
?>