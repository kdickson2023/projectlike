<?php  

/**
 * 
 */
class database
{
	private $con;
	public function connection()
	{	include_once("constants.php");
		$this->con= new Mysqli(host,user,pass,dtb);
		if ($this->con) {

			return $this->con;
			
		}else{
			return "CONNECTION_FAIL";
		}
	}
}


?>