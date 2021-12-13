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

        $this->dsc = $row["dscgenero"];
		
		return $stmt;
    }
}
?>