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
        $query = 'SELECT linkCapa FROM ' . $this->table . ' WHERE idcapa = ? LIMIT 1';
		
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		
		//Indicando o parâmetro na consulta
		$stmt->bindParam(1, $this->id);
		
		//Executa query
		$stmt->execute();
		$row = $stmt->fetch(PDO::FETCH_ASSOC);
		
		$this->link = $row['linkcapa'];
		
		return $stmt;
    }

}
?>