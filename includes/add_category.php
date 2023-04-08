<?php 


/**
 * 
 */
class category
{
	private $con;

	public function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}



	public function categoryExist($category_name){

		
		$pre_stmt = $this->con->prepare("SELECT `cid`, `category_name` FROM `categories` WHERE  category_name = ?");
		$pre_stmt->bind_param("s",$category_name);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows<1) {
			 return 0;
		}else{
			return 1;
		}
	}


	public function adCategory($catname){

		if ($this->categoryExist($catname)) {
			
			return "NAME_ALREADY_EXIST";
		}else{

		$status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `categories`(`category_name`, `status`) VALUES (?,?)");
		$pre_stmt->bind_param("si",$catname,$status);
		$result = $pre_stmt->execute() or die ($this->con->error);

		if ($result) {
			
			return "CATEGORY_ADDED";
		}else{

			return 0;
		}


		}

	}


}



 ?>