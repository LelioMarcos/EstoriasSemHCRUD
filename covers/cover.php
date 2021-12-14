<?php

class Cover {
    private $conn;
	private $table='hsemh.capa';

    public $id;
    public $link;

    public function __construct($db){
		$this->conn = $db;
	}

    public function get() {
        $query = 'SELECT idcapa, linkCapa FROM ' . $this->table . ' WHERE idcapa = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1, $this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->id = $row["idcapa"];

		if ($this->id != null) {
			$this->link = $row['linkcapa'];
			return true;
		}
		return false;
    }

	public function create() {
		$query = 'INSERT into ' . $this->table . ' (linkcapa)
		values (:linkcapa)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':linkcapa', $this->link);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idcapa = :id';
		
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