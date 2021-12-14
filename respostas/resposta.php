<?php


class Resposta {
    private $conn;
	private $table='hsemh.responde';
	
	//Propriedades POST
	public $id;
    public $id_coment_resp;
	public $id_coment;
	
	public function __construct($db){
		$this->conn = $db;
	}

    public function get_all() {
        $query = 'SELECT idresposta, idComentResp, idcoment FROM ' . $this->table . ' ORDER BY idresposta';
		//Preparando a execução da consulta
		$stmt = $this->conn->prepare($query);
		//Executa query
		$stmt->execute();
        
		return $stmt;
    }

	public function create() {
		$query = 'INSERT into ' . $this->table . ' (idComentResp, idcoment)
		values (:idComentResp, :idcoment)';
		
		//prepare statement
		$stmt = $this->conn->prepare($query);
		
		//binding of parameters
		$stmt->bindParam(':idComentResp', $this->id_coment_resp);
		$stmt->bindParam(':idcoment', $this->id_coment);
		
		//execute the query
		if($stmt->execute()){
			return true;
		}
		
		//print erro if something goes wrong
		printf("Error %s. \n", $stmt->error);
		
		return false;
	}
	
	public function delete(){
		$query = 'DELETE FROM '. $this->table . ' WHERE idresposta = :id';
		
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