<?php
//headers - comando que especifica características da resposta do cabeçalho HTTP.

//Domínios autorizados a acessar os recursos do servidor
header('Access-Control-Allow-Origin: *');

//Indica que o formato do corpo da solicitação é JSON
header('Content-Type: application/json');

//incializa banco de dados e método POST
include_once('../initialize.php'); 

//Instanciando objeto
$user = new User($db);

//Verifica se existe o id passado por parâmetro
$user->id = isset($_GET['id']) ? $_GET['id'] : die();

if (isset($_GET['no_photo'])) {
    if($user->get_no_photo()) {
        $post_item = array(
            'idusuario' => $user->id,
            'nomusuario' => html_entity_decode($user->nome),
            'dscemailusuario' => html_entity_decode($user->email),
            'senhausuario' => html_entity_decode($user->senha),
            'dscbiousuario' => html_entity_decode($user->bio),
            'success' => 1			
        );
        
        print_r(json_encode($post_item));
    } else {
        
        print_r(json_encode(array (
            "message" => "User not found",
            "success" => 0
        )));
    }
} else {
    if($user->get()) {
        $post_item = array(
            'idusuario' => $user->id,
            'nomusuario' => html_entity_decode($user->nome),
            'dscemailusuario' => html_entity_decode($user->email),
            'senhausuario' => html_entity_decode($user->senha),
            'dscbiousuario' => html_entity_decode($user->bio),
            'linkfotousuario' => html_entity_decode($user->foto),
            'success' => 1			
        ); 

        print_r(json_encode($post_item));
    } else {
        
        print_r(json_encode(array (
            "message" => "User not found",
            "success" => 0
        )));
    }
}
?>