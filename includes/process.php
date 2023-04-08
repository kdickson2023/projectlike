<?php 

include_once("../database/constants.php");
include_once("user.php");
include_once("add_category.php");
include_once("pagesmange.php");
include_once("getAllRecods.php");
include_once("addFunction.php");
include_once("singlerecord.php");


//For Registration Processsing
if (isset($_POST["username"]) AND isset($_POST["email"])) {
	$user = new user();
	$result = $user->createUserAccount($_POST["username"],$_POST["email"],$_POST["password1"],$_POST["usertype"]);
	echo $result;
	exit();
}

if (isset($_POST["log_email"]) AND isset($_POST["log_password"])) {
	$user = new User();
	$result=$user->loginUser($_POST["log_email"] ,$_POST["log_password"]);
	echo $result;
}

// adding category processing data

if (isset($_POST["category_name"])) {
	
	$obj = new category();
	$result=$obj->adCategory($_POST["category_name"]);
	echo $result;


}

// manage category processing data

if (isset($_POST["manageCategory"])) {
	$m = new pagesMange();
	$result = $m->getcategory("categories");
	$rows = $result;
	if (count($rows) > 0) {
		$n = 0;
		foreach ($rows as $row) {
			?>
				<tr>
			        <td><?php echo ++$n; ?></td>
			        <td><?php echo $row["category_name"]; ?></td>

			        <td><a href="#" class="btn btn-success btn-sm">Active</a></td>
			        <td><a href="#" did="<?php echo $row['cid']; ?>" class="btn btn-danger btn-sm del_cat">Delete</a></td>
			         <td><a href="#" eid="<?php echo $row['cid']; ?>" data-toggle="modal" data-target="#form_category" class="btn btn-info btn-sm edit_cat">Edit</a></td>
			      </tr>
			<?php
		
		}
		
	}
}


//fetch get Category
if (isset($_POST["manageCategory"])) {
	$obj = new getRecord();
	$rows = $obj->getAllRecord("categories");
	foreach ($rows as $row) {
		echo "<option value='".$row["cid"]."'>".$row["category_name"]."</option>";
	}
	exit();
}

// adding product name

if (isset($_POST["added_date"]) AND isset($_POST["product_name"])) {
	$obj = new addData();
	$result=$obj->adProduct($_POST["select_cat"],
							$_POST["product_name"],
							$_POST["product_qty"],
							$_POST["Product_price"],
							$_POST["product_cost"],
							$_POST["pro_date"],
							$_POST["expire_date"],
							$_POST["added_date"]);
	echo $result;
}

//adding customer

if (isset($_POST["cust_name"]) AND isset($_POST["c_contact"])) {
	$m = new addData();
	$result=$m->adCustomer($_POST["cust_name"],
							$_POST["c_contact"],
							$_POST["c_location"],
							$_POST["added_date"]

							);
	echo $result;
	exit();
}



if (isset($_POST["getNewOrderItem"])) {
	$obj = new getRecord();
	$rows = $obj->getAllRecord("products");
	?>
	<tr>
		    <td><b class="number">1</b></td>
		    <td>
		        <select name="pid[]" class="form-control form-control-sm pid" required>
		            <option value="">Choose Product</option>
		            <?php 
		            	foreach ($rows as $row) {
		            		?><option value="<?php echo $row['pid']; ?>"><?php echo $row["product_name"]; ?></option><?php
		            	}
		            ?>
		        </select>
		    </td>
		    <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm tqty"></td>   
		    <td><input name="qty[]" type="text" class="form-control form-control-sm qty" required></td>
		    <td><input name="price[]" type="text" class="form-control form-control-sm price" readonly></span>
		    <span><input name="pro_name[]" type="hidden" class="form-control form-control-sm pro_name"></td>
		    <td>Gh¢.<span class="amt">0</span></td>

	</tr>
	<?php
	exit();
}



		/// selecting customer name

	if (isset($_POST["getcustomer"])) {
	$obj = new getRecord();
	$rows = $obj->getAllRecord("customers");
	foreach ($rows as $row) {
		echo "<option value='".$row["cust_id"]."'>".$row["cust_name"]."</option>";
	}
	exit();
}

	
	//Get location and contact of one customer
if (isset($_POST["getConAndLoc"])) {
	$m = new singleRecord();
	$result = $m->getSingleRecord("customers","cust_id",$_POST["id"]);
	echo json_encode($result);
	exit();
}


//Get price and qty of one item
if (isset($_POST["getPriceAndQty"])) {
	$m = new singleRecord();
	$result = $m->getSingleRecord("products","pid",$_POST["id"]);
	echo json_encode($result);
	exit();
}

/// process insert order form

	if (isset($_POST["order_date"]) AND isset($_POST["cust_name"])) {
	
	$orderdate = $_POST["order_date"];
	$cust_name = $_POST["cust_name"];
	$order_contact = $_POST["order_contact"];
	$order_location = $_POST["order_location"];


	//Now getting array from order_form
	$ar_tqty = $_POST["tqty"];
	$ar_qty = $_POST["qty"];
	$ar_price = $_POST["price"];
	$ar_pro_name = $_POST["pro_name"];


	$sub_total = $_POST["sub_total"];
	$discount = $_POST["discount"];
	$net_total = $_POST["net_total"];


	$m = new addData();
	echo $result = $m->storeCustomerOrderInvoice($cust_name,$contact,$location,$order_date,$ar_tqty,$ar_qty,$ar_price,$ar_pro_name,$sub_total,$discount,$net_total);




}


 ?>