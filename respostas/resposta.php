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

    // public function get() {
    //     $query = 'SELECT idgenero, dscgenero FROM ' . $this->table . ' WHERE idgenero = ? LIMIT 1';
	// 	//Preparando a execução da consulta
	// 	$stmt = $this->conn->prepare($query);

    //     $stmt->bindParam(1, $this->id);
	// 	//Executa query
	// 	$stmt->execute();

    //     $row = $stmt->fetch(PDO::FETCH_ASSOC);

    //     $this->dsc = $row["dscgenero"];
		
	// 	return $stmt;
    // }
}
?>