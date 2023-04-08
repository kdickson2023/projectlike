<?php  
		require_once("connection.php");

						if(isset($_POST['order_form']))

						{
							$added_date = $_POST['added_date'];
							$cust_name = $_POST['cust_name'];
                            $order_contact = $_POST['order_contact'];
                            $order_location = $_POST['order_location'];
                            $sub_total = $_POST['sub_total'];
                            $discount = $_POST['discount'];
                            $net_total = $_POST['net_total'];

							$sql = "INSERT INTO `invoice1`(`customer_name`, `contact`, `location`, `order_date`, `sub_total`, `discount`, `net_total`) VALUES ('$added_date','$cust_name','$order_contact','$order_location','$discount','$net_total')";
                            $result = mysqli_query($con,$sql);

                            if($result){

							$invoice_no = $_POST['invoice_no'];
                            $product_name = $_POST['product_name'];
                            $price = $_POST['price'];
                            $qty = $_POST['qty'];

							foreach ($invoice_no as $index => $names) 
							{
								$u_name = $names;
								$u_email = $product_name[$index];
                                $u_price = $price[$index];
                                $u_qty = $qty[$index];
							$query = "INSERT INTO `invoice_details`(`invoice_no`, `product_name`, `price`, `qty`) VALUES ("$invoice_no","$product_name","$price","$qty")";
							$result = mysqli_query($con,$query);
								
                            }
                            

                            }
						}


?>