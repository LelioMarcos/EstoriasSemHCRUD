<?php
include_once "initialize.php";
$query = 'SELECT * FROM hsemh.comentario ORDER BY idhist';
//Preparando a execução da consulta
$stmt = $db->prepare($query);
//Executa query
$stmt->execute();

echo implode(", ", $stmt->fetch(PDO::FETCH_ASSOC));
?>