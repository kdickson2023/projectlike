<?php  

class addOrder
{


	private $con;

	public function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}
			
public function storeCustomerOrderInvoice($cust_name,$contact,$location,$order_date,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$discount,$net_total){
		$pre_stmt = $this->con->prepare("INSERT INTO `invoice1`(`customer_name`, `contact`, `location`, `order_date`, `sub_total`, `discount`, `net_total`) VALUES (?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("isssddd",$cust_name,$contact,$location,$order_date,$sub_total,$discount,$net_total);
		$pre_stmt->execute() or die($this->con->error);
		$number = $pre_stmt->insert_id;
		if ($number != null) {
			for ($i=0; $i < count($ar_price) ; $i++) {

				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`)
				 VALUES (?,?,?,?)");
				$insert_product->bind_param("ssdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);
			}

			return $number;
		}

	}

				

}

//$obj= new addOrder();
	//echo $obj->storeCustomerOrderInvoice( "9" ,"0546519974","dome" ,"2022-1-13", "10","125","multifruita1lx12" ,"125" ,"0","125");



?>