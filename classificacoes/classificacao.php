<?php

class Classificacao {
    private $conn;
	private $table='hsemh.classificacao';
	
	//Propriedades POST
	public $id;
    public $dsc;
	
	public function __construct($db){
		$this->conn = $db;
	}
	
	//Obtendo POST do banco de dados
	public function get(){
		//Criando query
		$query = 'SELECT idclassificacao, dscclassificacao FROM ' . $this->table . ' WHERE idclassificacao = ? LIMIT 1';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);

        $stmt->bindParam(1,$this->id);
		//Executa query
		$stmt->execute();
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row['idclassificacao'];

        if ($this->id != null) {
			$this->dsc = $row['dscclassificacao'];

			return true;
		}
		
		return false;

		
		return $stmt;
		
	}

	public function create() {
		$query = 'INSERT into ' . $this->table . ' (dscclassificacao)
		values (:dscclassificacao)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':dscclassificacao', $this->dsc);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idclassificacao = :id';
		
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