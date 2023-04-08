<?php 


/**
 * 
 */
class addData
{


	private $con;

	public function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}



	public function ProductNameExist($product_name){

		
		$pre_stmt = $this->con->prepare("SELECT `pid`, `product_name` FROM `products` WHERE  product_name = ?");
		$pre_stmt->bind_param("s",$product_name);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows<1) {
			 return 0;
		}else{
			return 1;
		}
	}


	public function adProduct($cid,$product_name,$stock,$price,$cost,$ex_date,$pro_date,$date){

		if ($this->ProductNameExist($product_name)) {
			
			return "NAME_ALREADY_EXIST";
		}else{

		$status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `products`(`cid`, `product_name`, `product_stock`, `product_price`, `product_cost`, `expire_date`, `pro_date`, `added_date`, `p_status`) VALUES (?,?,?,?,?,?,?,?,?)");

		$pre_stmt->bind_param("isdddssss",$cid,$product_name,$stock,$price,$cost,$ex_date,$pro_date,$date,$status);
		$result = $pre_stmt->execute() or die ($this->con->error);

		if ($result) {
			
			return "NEW_PRODUCT_ADDED";
		}else{

			return 0;
		}


		}

	}


	public function customerExist($cust_name){

		
		$pre_stmt = $this->con->prepare("SELECT `cust_id`, `cust_name` FROM `customers` WHERE cust_name =?");
		$pre_stmt->bind_param("s",$cust_name);
		$pre_stmt->execute() or die($this->con->error);
		$result = $pre_stmt->get_result();
		if ($result->num_rows<1) {
			 return 0;
		}else{
			return 1;
		}
	}


	public function adCustomer($cust_name,$cust_contact,$cust_location){

		if ($this->customerExist($cust_name)) {
			
			return "CUSTOMER_EXIST";
		}else{

		$add_date= date("Y-m-d");
		$cust_status = 1;
		$pre_stmt = $this->con->prepare("INSERT INTO `customers`(`cust_name`, `cust_contact`, `cust_location`, `add_date`, `cust_status`) VALUES (?,?,?,?,?)");
		$pre_stmt->bind_param("ssssi",$cust_name,$cust_contact,$cust_location,$add_date,$cust_status);
		$result = $pre_stmt->execute() or die ($this->con->error);

		if ($result) {
			
			return "CUSTOMER_ADDED";
		}else{

			return 0;
		}


		}

}


			
public function storeCustomerOrderInvoice($cust_name,$contact,$location,$order_date,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$discount,$net_total){
		$pre_stmt = $this->con->prepare("INSERT INTO `invoice1`(`customer_name`, `contact`, `location`, `order_date`, `sub_total`, `discount`, `net_total`) VALUES (?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("isssddd",$cust_name,$contact,$location,$order_date,$sub_total,$discount,$net_total);
		$result = $pre_stmt->execute() or die($this->con->error);

		if ($result != null) {
		

				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_product->bind_param("ssdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);

		}



	}
			






}

//$m= new addData();
//echo $m->adCustomer("yahoo","0200410962" ,"accra");
//echo $m->storeCustomerOrderInvoice("2022-11-21","yahoo" ,"0546519974","dome","11" ,"20" ,"5" ,"15" ,"vitamilk energy 24x33cl" ,"150" ,"0" ,"150" );
//$m = new addData();
//echo "<pre>";
//print_r($m->storeCustomerOrderInvoice("000525","vitamilk energy 24x33cl", "150", "15"));


 ?>

