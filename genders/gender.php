<?php
class Gender {
    private $conn;
	private $table='hsemh.genero';
	
	//Propriedades POST
	public $id;
	public $dsc;
	
	public function __construct($db){
		$this->conn = $db;
	}

    public function get_all() {
        $query = 'SELECT idgenero, dscgenero FROM ' . $this->table . ' ORDER BY idgenero';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
        
		
		return $stmt;
    }

    public function get() {
        $query = 'SELECT idgenero, dscgenero FROM ' . $this->table . ' WHERE idgenero = ? LIMIT 1';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);

        $stmt->bindParam(1, $this->id);
		//Executa query
		$stmt->execute();

        $row = $stmt->fetch(PDO::FETCH_ASSOC);

		$this->id = $row["idgenero"];

		if ($this->id != null) {
        	$this->dsc = $row["dscgenero"];

			return true;
		}
		
		return false;
    }

	public function create() {
		$query = 'INSERT into ' . $this->table . ' (dscGenero)
		values(:dscgenero)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':dscgenero', $this->dsc);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idgenero = :id';
		
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
		SET dscgenero = :dscgenero
		WHERE idgenero = :id';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);

		$stmt->bindParam(':id', $this->id);
		$stmt->bindParam(':dscgenero', $this->dsc);
		
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