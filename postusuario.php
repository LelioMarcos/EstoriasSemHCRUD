<?php

class PostUsuario {
    private $conn;
	private $table='hsemh.usuario';
	
	//Propriedades POST
	public $id;
	public $nome;
	public $email;
	public $senha;
    public $bio;
    public $foto;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function read(){
		//Criando query
		$query = 'SELECT idusuario, nomusuario, dscemailusuario, senhausuario, dscbiousuario, linkfotousuario FROM ' . $this->table . ' ORDER BY idusuario';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
		
	}
	
	public function read_single(){
		//Criando query
		$query = 'SELECT idusuario, nomusuario, dscemailusuario, senhausuario, dscbiousuario, linkfotousuario FROM ' . $this->table . ' WHERE idusuario = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1,$this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row['idusuario'];
		$this->nome = $row['nomusuario'];
		$this->email = $row['dscemailusuario'];
		$this->senha = $row['senhausuario'];
        $this->bio = $row['dscbiousuario'];
        $this->foto = $row['linkfotousuario'];
		
	
		return $stmt;
		
	}
	
	public function create(){
		$query = 'INSERT INTO '. $this->table . ' SET nomusuario = :nomusuario';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->nome = htmlspecialchars(strip_tags($this->nome));
		
		//binding of parameters
		$stmt->bindParam(':nomusuario', $this->nome);
		
		//execute the query
		if($stmt->execute()){
			return true;
			
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
    /*
	public function update(){
		$query = 'UPDATE '. $this->table . ' SET titulo = :titulo WHERE id = :id';
	
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->titulo = htmlspecialchars(strip_tags($this->titulo));
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		//binding of parameters
		$stmt->bindParam(':titulo', $this->titulo);
		$stmt->bindParam(':id', $this->id);
	
		//execute the query
		if($stmt->execute()){
			return true;
		
		}
	
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
	
		return false;
	}
	*/
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idusuario = :idusuario';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		//clean data
		$this->id = htmlspecialchars(strip_tags($this->id));
	
		//binding of parameters
		$stmt->bindParam(':idusuario', $this->id);
	
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