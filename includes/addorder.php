<?php 


/**
 * 
 */
class addorder
{
	private $con;

	public function __construct()
	{
		include_once("../database/db.php");
		$db = new database();
		$this->con = $db->connection();
	}


 public function storeCustomerOrderInvoice($orderdate,$select_cat,$order_contact,$order_location,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$discount,$net_total){

 		$orderdate = date("Y:m:d");
		$pre_stmt = $this->con->prepare("INSERT INTO `invoice`(`customer_name`, `contact`, `location`, `order_date`, `sub_total`, `discount`, `net_total`) VALUES (?,?,?,?,?,?,?)");
		$pre_stmt->bind_param("ssssddd",$select_cat,$order_contact,$order_location,$orderdate,$sub_total,$discount,$net_total);
		$pre_stmt->execute() or die($this->con->error);
		$invoice_no = $pre_stmt->insert_id;
		if ($invoice_no != null) {

			for ($i=0; $i < count($ar_price); $i++) {

				//Here we are finding the remaing quantity after giving customer
				$rem_qty = $ar_tqty[$i] - $ar_qty[$i];
				if ($rem_qty < 0) {
					return "ORDER_FAIL_TO_COMPLETE";
				}else{
					//Update Product stock
					$sql = "UPDATE products SET product_stock = '$rem_qty' WHERE product_name = '".$ar_pro_name[$i]."'";
					$this->con->query($sql);
				}


				$insert_product = $this->con->prepare("INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES (?,?,?,?)");
				$insert_product->bind_param("isdd",$invoice_no,$ar_pro_name[$i],$ar_price[$i],$ar_qty[$i]);
				$insert_product->execute() or die($this->con->error);
			}

			return "ORDER_COMPLETED";
		}

	}

			






}

//$m= new addorder();
//echo $m->storeCustomerOrderInvoice("2022-11-21","imesco" ,"0546519974","dome","11","20" ,"5" ,"15" ,"vitamilk energy 24x33cl" ,"150" ,"0" ,"150");

 ?>

