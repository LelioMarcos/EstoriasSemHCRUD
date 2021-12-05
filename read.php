<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('initialize.php'); 

//Instancia objeto Post com a conexão com o banco de dados
$post = new Post($db);

//Chamada ao método read da classe POST
$result = $post->read();


//Obtém a quantidade de linhas
$num = $result->rowCount();

if ($num > 0){
	$post_arr = array();
	$post_arr['data'] = array();
	
	//fetch - função que lê o próximo registro. Recebe como entrada o parâmetro 
	/*PDO::FETCH_ASSOC: Retorna um array indexado pelo nome da coluna.
	Array
	(
		[name] => apple
		[colour] => red
	)
	*/
	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		//extrai dados do array
		extract($row);
		$post_item = array(
		'idhist' => $row['idhist'],
		'nomhist' => html_entity_decode($row['nomhist']),
		'dscsinopsehist' => html_entity_decode($row['dscsinopsehist']),
		'dsccorpohist' => html_entity_decode($row['dsccorpohist'])				
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($post_arr['data'],$post_item);
	}
	//Converte para JSON a saída
	echo json_encode($post_arr);
	
}else{
	echo json_encode(array('message' => 'No posts found.'));
}

?>