<?php 

/**
 * 
 */
class pagesMange
{
	
	private $con;

	function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}



	public function getcategory($table){
		$pre_stmt = $this->con->prepare("SELECT * FROM ".$table);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		$rows = array();
		if ($result->num_rows > 0) {
			while($row = $result->fetch_assoc()){
				$rows[] = $row;
			}
			return $rows;
		}
		return "NO_DATA";
	}

	

}

//$obj=new pagesMange();

//echo "<pre>";
//print_r($obj->getcategory("categories"));

 ?>