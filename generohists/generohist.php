<?php

class GeneroHist {
    private $conn;
	private $table='hsemh.GeneroHist';
	
	//Propriedades POST
	public $id;
    public $idgenero;
    public $idhist;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function get_from_story(){
		//Criando query
		$query = 'SELECT idgenerohist, fk_historia_idhist, fk_genero_idgenero FROM ' . $this->table . ' WHERE fk_historia_idhist = ?';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->idhist);
		//Executa query
		$stmt->execute();
		
		return $stmt;
	}

    //Obtendo POST do banco de dados
	public function get_all(){
		//Criando query
		$query = 'SELECT idgenerohist, fk_historia_idhist, fk_genero_idgenero FROM ' . $this->table . ' ORDER BY idgenerohist';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
		
		return $stmt;
	}
	// public function create(){
	// 	$query = 'INSERT into ' . $this->table . ' (dsccorpocoment, idusuario, idhist)
	// 	values(:dsccorpocoment, :idusuario, :idhist)';
		
	// 	//prepare statement
	// 	$stmt = $this->conn->prepare($query);
		
	// 	$this->comment = htmlspecialchars(strip_tags($this->comment));

	// 	//binding of parameters
	// 	$stmt->bindParam(':dsccorpocoment', $this->comment);
	// 	$stmt->bindParam(':idusuario', $this->idusuario);
	// 	$stmt->bindParam(':idhist', $this->idhist);
		
	// 	//execute the query
	// 	if($stmt->execute()){
	// 		return true;
	// 	}
		
	// 	//print erro if something goes wrong
	// 	printf("Error %s. \n", $stmt->error);
		
	// 	return false;
	// }
	
    
	// public function update(){
	// 	$query = 'UPDATE '. $this->table . ' SET dsccorpocoment = :dsccorpocoment WHERE id = :id';
	
	// 	//prepare statement
	// 	$stmt = $this->conn->prepare($query);
	// 	//clean data
	// 	$this->comment = htmlspecialchars(strip_tags($this->comment));
	// 	$this->id = htmlspecialchars(strip_tags($this->id));
	
	// 	//binding of parameters
	// 	$stmt->bindParam(':dsccorpocoment', $this->comment);
	// 	$stmt->bindParam(':idcoment', $this->id);
	
	// 	//execute the query
	// 	if($stmt->execute()){
	// 		return true;
		
	// 	}
	
	// 	//print erro if something goes wrong
	// 	printf("Error %s. \n", $stmt->error);
	
	// 	return false;
	// }
	
	
	// public function delete(){
	// 	$query = 'DELETE FROM '. $this->table . ' WHERE idcoment = :id';
		
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