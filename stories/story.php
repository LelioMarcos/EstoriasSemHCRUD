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
	public $classificacao;
	public $nota;
	public $capa;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function get_all(){
		//Criando query
		$query = 'SELECT * FROM ' . $this->table . ' ORDER BY idhist';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}

	//Obtendo POST do banco de dados
	public function get_from_user(){
		//Criando query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE idusuario = ?';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->idusuario);
		
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}

	public function get_from_gender($genero){
		//Criando query
		$query = 'SELECT h.* from ' . $this->table . ' h 
		join hsemh.generohist gh on (gh.fk_historia_idhist = h.idhist) 
		join hsemh.genero g on (gh.fk_genero_idgenero = g.idgenero) 
		where g.dscgenero like ?;';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1, $genero);
		
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}

	//Obtendo POST do banco de dados
	public function search($search_query){
		//Criando query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE nomhist LIKE ?';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		$search_query = "%{$search_query}%";
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$search_query);
		
		//Executa query
		$stmt->execute();
		
		return $stmt;
	}
	
	public function get(){
		//Criando query
		$query = 'SELECT * FROM ' . $this->table . ' WHERE idhist = :id LIMIT 1';
		
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
			$this->nota = $row['notahist'];
			$this->idusuario = $row['idusuario'];
			$this->capa = $row['idcapa'];
			$this->classificacao = $row['idclassificacao'];

			return true;
		}
		
		
		return false;
	}
	
	public function create(){
		$query = 'INSERT into hsemh.historia (nomhist, dscsinopsehist, notahist, dsccorpohist, idusuario, idcapa, idclassificacao)
		values(:nomhist, :dscsinopsehist, 0.00, :dsccorpohist, :idusuario, 3, 2) RETURNING idhist';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':nomhist', $this->titulo);
		$stmt->bindParam(':dscsinopsehist', $this->sinopse);
		$stmt->bindParam(':dsccorpohist', $this->corpo);
		$stmt->bindParam(':idusuario', $this->idusuario);
		
		//execute the query
		if($stmt->execute()){
			$result = $stmt->fetch(PDO::FETCH_ASSOC);
			$this->id = $result["idhist"];
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
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

	public function update(){
		$query = 'UPDATE '. $this->table . ' 
		SET nomhist = :nomhist,
			dscsinopsehist = :dscsinopsehist,
			dsccorpohist = :dsccorpohist,
			notahist = :notahist,
			idcapa = :idcapa
		WHERE idhist = :id';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':nomhist', $this->titulo);
		$stmt->bindParam(':dscsinopsehist', $this->sinopse);
		$stmt->bindParam(':dsccorpohist', $this->corpo);
		$stmt->bindParam(':notahist', $this->nota);
		$stmt->bindParam(':idcapa', $this->idcapa);
		
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