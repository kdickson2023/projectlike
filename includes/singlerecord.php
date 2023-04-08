<?php
/**
* 
*/
class singleRecord
{
	
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}
	
	public function getSingleRecord($table,$pk,$id){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table." WHERE ".$pk."= ? LIMIT 1");
		$pre_stmt->bind_param("i",$id);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows == 1) {
			$row = $result->fetch_assoc();
		}
		return $row;
	}






}



?>