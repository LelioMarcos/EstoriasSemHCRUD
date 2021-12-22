<?php
//headers - comando que especifica características da rescommenta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');
//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método comment
include_once('../initialize.php'); 

//Instancia objeto comment com a conexão com o banco de dados
$comment = new Comment($db);

$comment->idhist = isset($_GET['id_story']) ? $_GET['id_story'] : die();
$result = $comment->read_from_story();

//Obtém a quantidade de linhas
$num = $result->rowCount();

if ($num > 0){
	$comment_arr = array();
	$comment_arr['data'] = array();

	while($row = $result->fetch(PDO::FETCH_ASSOC)){
		//extrai dados do array
		extract($row);
		$comment_item = array(
			'idcoment' => $row['idcoment'],
			'idusuario' => $row['idusuario'],
			'nomusuario' => $row['nomusuario'],
			'dsccorpocoment' => html_entity_decode($row['dsccorpocoment']),			
		);
		
		//Adiciona um ou mais elementos no final de um array
		array_push($comment_arr['data'],$comment_item);
	}
	//Converte para JSON a saída
	$comment_arr['success'] = 1;
	echo json_encode($comment_arr);
} else {
	header(http_response_code(404));
	echo json_encode(array('message' => 'No comments found.', 'success' => 0));
}

?>