<?php
class User { 
    
    private $conn;
    private $userTable = "users"; 
   	public $id;
    public $username;
    public $password;   
    
    public function __construct($db){
        $this->conn = $db;
    }	
		
	function listAll($idStaff,$idCabinet){		
		$stmt = $this->conn->prepare("
			SELECT * FROM `relstaffcab`,`cabinet`,`users` 
			WHERE users.typeCompte = '$idStaff' AND cabinet.idCabinet = '$idCabinet' AND users.identifiant = relstaffcab.identifiantStaff AND relstaffcab.idCabinet = cabinet.idCabinet");
		$stmt->execute();			
		$result = $stmt->get_result();		
		return $result;	
	}	
}
?>