<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$user = new User($db);

//Chamada ao método read da classe POST
$result = $user->read();

//Obtém a quantidade de linhas
$num = $result->rowCount();

if ($num > 0){
	$user_arr = array();
	$user_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		//extrai dados do array
		extract($row);
		$user_item = array(
			'idusuario' => $row['idusuario'],
			'nomusuario' => html_entity_decode($row['nomusuario']),
			'dscemailusuario' => html_entity_decode($row['dscemailusuario']),
			'senhausuario' => html_entity_decode($row['senhausuario']),
			'dscbiousuario' => html_entity_decode($row['dscbiousuario']),
			'linkfotousuario' => html_entity_decode($row['linkfotousuario'])			
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($user_arr['data'],$user_item);
	}
	//Converte para JSON a saída
	header(http_response_code(200));
	echo json_encode($user_arr);
	
}else{
	header(http_response_code(404));
	echo json_encode(array('message' => 'No posts found.'));
}

?>