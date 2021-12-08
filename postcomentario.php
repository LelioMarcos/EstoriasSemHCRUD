<?php

class PostComentario {
    private $conn;
	private $table='hsemh.comentario';
	
	//Propriedades POST
	public $id;
	public $comment;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function read(){
		//Criando query
		$query = 'SELECT idcoment, dsccorpocoment FROM ' . $this->table . ' ORDER BY idcoment';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function read_single(){
		//Criando query
		$query = 'SELECT idcoment, dsccorpocoment FROM ' . $this->table . ' WHERE idcoment = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idcoment'];
		$this->comment = $row['dsccorpocoment'];
		
		return $stmt;
		
	}
	
	public function create(){
		$query = 'INSERT INTO '. $this->table . ' SET dsccorpocoment = :dsccorpocoment';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->comment = htmlspecialchars(strip_tags($this->comment));
		
		//binding of parameters
		$stmt->bindParam(':dsccorpocoment', $this->comment);
		
		//execute the query
		if($stmt->execute()){
			return true;
			
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
    
	public function update(){
		$query = 'UPDATE '. $this->table . ' SET dsccorpocoment = :dsccorpocoment WHERE id = :id';
	
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->comment = htmlspecialchars(strip_tags($this->comment));
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		//binding of parameters
		$stmt->bindParam(':dsccorpocoment', $this->comment);
		$stmt->bindParam(':idcoment', $this->id);
	
		//execute the query
		if($stmt->execute()){
			return true;
		
		}
	
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
	
		return false;
	}
	
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idcoment = :idcoment';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		//binding of parameters
		$stmt->bindParam(':idcoment', $this->id);
	
		//execute the query
		if($stmt->execute()){
			return true;
			
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
}

?>