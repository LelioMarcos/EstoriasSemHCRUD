<?php

class Story {
	private $conn;
	private $table='hsemh.historia';
	
	//Propriedades POST
	public $id;
	public $titulo;
	public $sinopse;
	public $corpo;
	public $idusuario;
	public $capa;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function get(){
		//Criando query
		$query = 'SELECT idhist, nomhist, dscsinopsehist, dsccorpohist, idcapa FROM ' . $this->table . ' ORDER BY idhist';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}

	//Obtendo POST do banco de dados
	public function get_from_user(){
		//Criando query
		$query = 'SELECT idhist, nomhist, dscsinopsehist, dsccorpohist, idcapa FROM ' . $this->table . ' WHERE idusuario = ?';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->idusuario);
		
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function read_single(){
		//Criando query
		$query = 'SELECT idhist, nomhist, dscsinopsehist, dsccorpohist, idcapa FROM ' . $this->table . ' WHERE idhist = :id LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(":id", $this->id);

		$stmt->execute();

		$row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['idhist'];
		
		//Executa query
		if ($this->id != null) {
			$this->titulo = $row['nomhist'];
			$this->sinopse = $row['dscsinopsehist'];
			$this->corpo = $row['dsccorpohist'];
			$this->capa = $row['idcapa'];

			return true;
		}
		
		
		return false;
	}
	
	public function create(){
		$query = 'INSERT into ' . $this->table . ' (nomhist, dscsinopsehist, notahist, dsccorpohist, idusuario, idcapa)
		values(:nomhist, :dscsinopsehist, 0, :dsccorpohist, :idusuario, :idcapa)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		
		//binding of parameters
		$stmt->bindParam(':nomhist', $this->titulo);
		$stmt->bindParam(':dscsinopsehist', $this->sinopse);
		$stmt->bindParam(':dsccorpohist', $this->corpo);
		$stmt->bindParam(':idusuario', $this->idusuario);
		$stmt->bindParam(':idcapa', $this->idcapa);
		
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
	
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idhist = :id';
		
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