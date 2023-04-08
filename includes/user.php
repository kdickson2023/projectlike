<?php 

/**
 * 
 */
class user
{
	private $con;
	function __construct()
	{
		include_once("../database/db.php");
		$db=new database();
		$this->con=$db->connection();
	}

	private function emailExist($email){
		$pre_stmt=$this->con->prepare("SELECT id FROM user WHERE email=?");
		$pre_stmt->bind_param("s",$email);
		$pre_stmt->execute() or die($this->con->error);
		$result=$pre_stmt->get_result();
		if ($result->num_rows<1) {
			return 0;
		}else{
			return 1;
		}

	}


	public function createUserAccount($username,$email,$password,$usertype){
		if ($this->emailExist($email)) {
			return "EMAIL_ALREADYEXIST";
		}else{

			$note="";
			$date=date("Y-m-d");
			$pass_hash = password_hash($password,PASSWORD_BCRYPT,["cost"=>8]);
			$pre_stmt=$this->con->prepare("INSERT INTO `user`(`username`, `email`, `password`, `usertype`, `register_date`, `last_login`, `notes`) VALUES (?,?,?,?,?,?,?)");
			$pre_stmt->bind_param("sssssss",$username,$email,$pass_hash,$usertype,$date,$date,$note);
			$result=$pre_stmt->execute() or die($this->con->error);
			if ($result) {
				return $this->con->insert_id;
			}else{
				return "SOME_ERROR";
			}

		}
	}

	
	public function loginUser($email,$password){
			$pre_stmt=$this->con->prepare("SELECT id, username, password, last_login FROM user WHERE email=?");
			$pre_stmt->bind_param("s",$email);
			$pre_stmt->execute() or die($this->con->error);
			$result=$pre_stmt->get_result();
			if ($result->num_rows<1) {
				return "NOT_REGISTED";
			}else{
				$row=$result->fetch_assoc();
				if (password_verify($password, $row["password"])) {
					$_SESSION["userid"]=$row["id"];
					$_SESSION["username"]=$row["username"];
					$_SESSION["last_login"]=$row["last_login"];

					$last_login=date("Y-m-d h:m:s");
					$pre_stmt=$this->con->prepare("UPDATE user SET last_login=? WHERE email=?");
					$pre_stmt->bind_param("ss",$last_login,$email);
					$result=$pre_stmt->execute() or die($this->con->error);
					if ($result) {
						return 1;
					}else{
						return 0;
					}

				}else{
					return "PASSWORD_DONTMATCH";
				}
			}
	}



}

//$obj = new user();
///echo $obj->createUserAccount("dan","dan@gmail.com","125456","Admin");

//echo $obj->loginUser("dan@gmail.com","125456");


 ?>