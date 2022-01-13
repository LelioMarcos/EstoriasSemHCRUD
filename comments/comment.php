<?php

class Comment {
    private $conn;
	private $table='hsemh.comentario';
	
	//Propriedades POST
	public $id;
	public $idhist;
	public $idusuario;
	public $nomusuario;
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
		$query = 'SELECT c.idcoment, c.dsccorpocoment, c.idusuario, u.nomUsuario, u.linkfotousuario FROM ' . $this->table . ' c JOIN hsemh.usuario u ON (c.idusuario=u.idusuario) WHERE idhist = ? ORDER BY c.idcoment';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->idhist);
		//Executa query
		$stmt->execute();
		
		return $stmt;
	}
	
	public function get(){
		//Criando query
		$query = 'SELECT c.idcoment, c.idhist, c.dsccorpocoment, c.idusuario, u.nomUsuario FROM ' . $this->table . ' c JOIN hsemh.usuario u ON (c.idusuario=u.idusuario) WHERE idcoment = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idcoment'];

		if ($this->id != null) {
			$this->idusuario = $row['idusuario'];
			$this->comment = $row['dsccorpocoment'];
			$this->nomusuario = $row['nomusuario'];
			$this->idhist = $row['idhist'];

			return true;
		}
		
		return false;
		
	}
	
	public function create(){
		$query = 'INSERT into ' . $this->table . ' (dsccorpocoment, idusuario, idhist)
		values(:dsccorpocoment, :idusuario, :idhist)';
		
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
		$query = 'UPDATE '. $this->table . ' SET dsccorpocoment = :dsccorpocoment WHERE idcoment = :id';
	
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->comment = htmlspecialchars(strip_tags($this->comment));
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		//binding of parameters
		$stmt->bindParam(':dsccorpocoment', $this->comment);
		$stmt->bindParam(':id', $this->id);
	
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