<?php

class Comment {
    private $conn;
	private $table='hsemh.comentario';
	
	//Propriedades POST
	public $id;
	public $idhist;
	public $idusuario;
	public $comment;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function read(){
		//Criando query
		$query = 'SELECT idcoment, dsccorpocoment, idusuario FROM ' . $this->table . ' ORDER BY idcoment';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}

	public function read_from_story(){
		//Criando query
		$query = 'SELECT idcoment, dsccorpocoment, idusuario FROM ' . $this->table . ' WHERE idhist = ?';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->idhist);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function read_single(){
		//Criando query
		$query = 'SELECT idcoment, dsccorpocoment, idusuario FROM ' . $this->table . ' WHERE idcoment = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idcoment'];
		$this->idusuario = $row['idusuario'];
		$this->comment = $row['dsccorpocoment'];
		
		return $stmt;
		
	}
	
	public function create(){
		$query = 'INSERT into ' . $this->table . ' (idcoment, dsccorpocoment, idusuario, idhist)
		values(:idcoment, :dsccorpocoment, :idusuario, :idhist)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		$this->comment = htmlspecialchars(strip_tags($this->comment));

		//binding of parameters
		$stmt->bindParam(':dsccorpocoment', $this->comment);
		$stmt->bindParam(':idusuario', $this->idusuario);
		$stmt->bindParam(':idhist', $this->idhist);
		
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
		$query = 'DELETE FROM '. $this->table . ' WHERE idcoment = :id';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->id = htmlspecialchars(strip_tags($this->id));
		
		//binding of parameters
		$stmt->bindParam(':id', $this->id);
		
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