<?php

class POST{
	
	private $conn;
	private $table='hsemh.historia';
	
	//Propriedades POST
	public $id;
	public $titulo;
	public $sinopse;
	public $story;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function read(){
		//Criando query
		$query = 'SELECT idhist, nomhist, dscsinopsehist, dsccorpohist FROM ' . $this->table . ' ORDER BY idhist';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function read_single(){
		//Criando query
		$query = 'SELECT idhist, nomhist, dscsinopsehist, dsccorpohist FROM ' . $this->table . ' WHERE idhist = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idhist'];
		$this->titulo = $row['nomhist'];
		$this->sinopse = $row['dscsinopsehist'];
		$this->story = $row['dsccorpohist'];
		
	
		return $stmt;
		
	}
	
	public function create(){
		$query = 'INSERT INTO '. $this->table . ' SET nomhist = :nomhist';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		
		//binding of parameters
		$stmt->bindParam(':nomhist', $this->titulo);
		
		//execute the query
		if($stmt->execute()){
			return true;
			
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	// public function update(){
	// 	$query = 'UPDATE '. $this->table . ' SET titulo = :titulo WHERE id = :id';
		
	// 	//prepare statement
	// 	$stmt = $this->conn->prepare($query);
	// 	//clean data
	// 	$this->titulo = htmlspecialchars(strip_tags($this->titulo));
	// 	$this->id = htmlspecialchars(strip_tags($this->id));
		
	// 	//binding of parameters
	// 	$stmt->bindParam(':titulo', $this->titulo);
	// 	$stmt->bindParam(':id', $this->id);
		
	// 	//execute the query
	// 	if($stmt->execute()){
	// 		return true;
			
	// 	}
		
	// 	//print erro if something goes wrong
	// 	printf("Error %s. \n", $stmt->error);
		
	// 	return false;
	// }
	
	
	// public function delete(){
	// 	$query = 'DELETE FROM '. $this->table . ' WHERE id = :id';
		
	// 	//prepare statement
	// 	$stmt = $this->conn->prepare($query);
	// 	//clean data
	// 	$this->id = htmlspecialchars(strip_tags($this->id));
		
	// 	//binding of parameters
	// 	$stmt->bindParam(':id', $this->id);
		
	// 	//execute the query
	// 	if($stmt->execute()){
	// 		return true;
			
	// 	}
		
	// 	//print erro if something goes wrong
	// 	printf("Error %s. \n", $stmt->error);
		
	// 	return false;
	// }
}
?>