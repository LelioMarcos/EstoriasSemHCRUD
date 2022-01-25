<?php

class GeneroHist {
    private $conn;
	private $table='hsemh.GeneroHist';
	
	//Propriedades POST
	public $id;
    public $idgenero;
	public $nomgenero;
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

	public function create() {
		$query = 'INSERT into ' . $this->table . ' (fk_historia_idhist, fk_genero_idgenero)
		values (:fk_historia_idhist, (SELECT idgenero FROM hsemh.genero WHERE dscgenero LIKE :genero))';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':fk_historia_idhist', $this->idhist);
		$stmt->bindParam(':genero', $this->nomgenero);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}

	public function create_id() {
		$query = 'INSERT into ' . $this->table . ' (fk_historia_idhist, fk_genero_idgenero)
		values (:fk_historia_idhist, :fk_genero_idgenero)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':fk_historia_idhist', $this->idhist);
		$stmt->bindParam(':fk_genero_idgenero', $this->idgenero);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idgenerohist = :id';
		
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
		SET fk_historia_idhist = :fk_historia_idhist,
			fk_genero_idgenero = :fk_genero_idgenero
		WHERE idgenerohist = :id';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':fk_historia_idhist', $this->idhist);
		$stmt->bindParam(':fk_genero_idgenero', $this->idgenero);
		
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