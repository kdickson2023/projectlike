<?php
include_once("./database/constants.php");
if (!isset($_SESSION["userid"])) {
  header("location:".DOMAIN."/");
}

include_once("./fetchData/generateinvid.php");
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>Inventory Management System</title>
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js" integrity="sha384-vFJXuSJphROIrBnz7yo7oB41mKfc8JzQZiCq4NCceLEaO4IHwicKwpJf9c9IpFgh" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/js/bootstrap.min.js" integrity="sha384-alpBpkh1PFOepccYVYDB4do5UnbKysX5WZXm3XxPqe5iKTfUKjNkCk9SaVuEZflJ" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0-beta.2/css/bootstrap.min.css" integrity="sha384-PsH8R72JQ3SOdhVi3uxftmaW6Vc51MKb0q5P2rRUpPvrszuE4W1povHYgTpBfshb" crossorigin="anonymous">
  <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <script type="text/javascript" src="./js/order.js"></script>
 </head>
<body>
<div class="overlay"><div class="loader"></div></div>
  <!-- Navbar -->
  <?php include_once("./templates/header.php"); ?>
  <br/><br/>

  <div class="container">
    <div class="row">
      <div class="col-md-10 mx-auto">
        <div class="card" style="box-shadow:0 0 25px 0 lightgrey;">
          <div class="card-header">
            <h4>New Orders</h4>
          </div>
          <div class="card-body">
          <form id="get_order_data" onsubmit="return false">
          <div class="form-row">
            <div class="form-group col-md-2">
              <label>Order Date</label>
              <input type="text" class="form-control" name="added_date" id="added_date" value="<?php echo date("Y-m-d"); ?>" readonly/>
            </div>
            <div class="form-group col-md-3">
              <label>Customer Name</label>
              <select class="form-control cid" id="cust_name" name="cust_name" required/>          
            </select>
            </div>
            <div class="form-group col-md-3">
              <label>Contact</label>
              <input type="text" class="form-control con" name="order_contact" id="order_contact" placeholder="Contact"/>
            </div>
            <div class="form-group col-md-2">
              <label>Location</label>
              <input type="text" class="form-control loc" name="order_location" id="order_location" placeholder="Location"/>
            </div>
            <div class="form-group col-md-2">
              <label>Invoice</label>
              <input type="text" class="form-control invoiceN" value="<?php echo $number ?>" name="invoice_no" id="invoice_no" placeholder="Invoice" readonly />
            </div>
          </div>

          <br><br/>

          <div class="card" style="box-shadow:0 0 15px 0 lightgrey;">
                <div class="card-body">
                  <h3>Make a order list</h3>
                  <table align="center" style="width:800px;">
                                <thead>
                                  <tr>
                                    <th>#</th>
                                    <th style="text-align:center;">Item Name</th>
                                    <th style="text-align:center;">Total Quantity</th>
                                    <th style="text-align:center;">Quantity</th>
                                    <th style="text-align:center;">Price</th>
                                    <th>Total</th>
                                  </tr>
                                </thead>
                                <tbody id="invoice_item">
    <!--<tr>
        <td><b id="number">1</b></td>
        <td>
            <select name="pid[]" class="form-control form-control-sm" required>
                <option>Washing Machine</option>
            </select>
        </td>
        <td><input name="tqty[]" readonly type="text" class="form-control form-control-sm"></td>   
        <td><input name="qty[]" type="text" class="form-control form-control-sm" required></td>
        <td><input name="price[]" type="text" class="form-control form-control-sm" readonly></td>
        <td>Rs.1540</td>
    </tr>-->
                                </tbody>
                            </table> <!--Table Ends-->
                            <center style="padding:10px;">
                              <button id="add" style="width:150px;" class="btn btn-success">Add</button>
                              <button id="remove" style="width:150px;" class="btn btn-danger">Remove</button>
                            </center>
                </div> <!--Crad Body Ends-->
              </div> <!-- Order List Crad Ends-->
                <p></p>
                <div class="form-group row">
                      <label for="sub_total" class="col-sm-2 col-form-label" align="right">Gross Total</label>
                      <div class="col-sm-3">
                        <input type="text" readonly name="sub_total" class="form-control form-control-sm" id="sub_total" required/>
                      </div>
                 </div>

                 <div class="form-group row">
                      <label for="discount" class="col-sm-2 col-form-label" align="right">Discount</label>
                      <div class="col-sm-3">
                        <input type="text" name="discount" class="form-control form-control-sm" id="discount"/>
                      </div>

                   </div>

                  <div class="form-group row">
                      <label for="net_total" class="col-sm-2 col-form-label" align="right">Net Total</label>
                      <div class="col-sm-3">
                        <input type="text" readonly name="net_total" class="form-control form-control-sm" id="net_total" required/>
                      </div>
                   </div>

                   <div class="form-group row col-sm-4">
                      <input type="submit" id="order_form" style="width:150px;" class="btn btn-info" value="Order" align="center">
                      <input type="submit" id="print_invoice" style="width:150px;" class="btn btn-success d-none" value="Print Invoice">
                   </div>




        
        </form>

          </div>
        </div>
      </div>
    </div>
  </div>
  


</body>
</html>