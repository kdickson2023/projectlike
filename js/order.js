$(document).ready(function(){
	var DOMAIN = "http://localhost/dickson";


	addNewRow();

	$("#add").click(function(){
		addNewRow();
	})


	function addNewRow(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getNewOrderItem:1},
			success : function(data){
				$("#invoice_item").append(data);
				var n = 0;
				$(".number").each(function(){
					$(this).html(++n);
				})
				
			}
		})
	}

	$("#remove").click(function(){
		$("#invoice_item").children("tr:last").remove();
	})


	fetch_customer();
	function fetch_customer(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {getcustomer:1},
			success : function(data){
				var choose = "<option value=''>Choose customer</option>";
				$("#cust_name").html(choose+data);
			}
		})
	}

		//select customer with location from order form 

	$("#get_order_data").delegate(".cid","change",function(){
		var cid = $(this).val();
		var tr = $(this).parent().parent();
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {getConAndLoc:1,id:cid},
			success : function(data){
				tr.find(".con").val(data["cust_contact"]);
				tr.find(".loc").val(data["cust_location"]);

			}
		})
	})

	//select product wit quantity from order form

	$("#invoice_item").delegate(".pid","change",function(){
		var pid = $(this).val();
		var tr = $(this).parent().parent();
		$(".overlay").show();
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			dataType : "json",
			data : {getPriceAndQty:1,id:pid},
			success : function(data){
				tr.find(".tqty").val(data["product_stock"]);
				tr.find(".pro_name").val(data["product_name"]);
				tr.find(".qty").val(1);
				tr.find(".price").val(data["product_price"]);
				tr.find(".amt").html( tr.find(".qty").val() * tr.find(".price").val() );
				calculate(0,0);
			}
		})
	})


	$("#invoice_item").delegate(".qty","keyup",function(){
		var qty = $(this);
		var tr = $(this).parent().parent();
		if (isNaN(qty.val())) {
			alert("Please enter a valid quantity");
			qty.val(1);
		}else{
			if ((qty.val() - 0) > (tr.find(".tqty").val()-0)) {
				alert("Sorry ! This much of quantity is not available");
				aty.val(1);
			}else{
				tr.find(".amt").html(qty.val() * tr.find(".price").val());
				calculate(0,0);
			}
		}

	})

	function calculate(dis){
		var sub_total = 0;
		var net_total = 0;
		var discount = dis;
		$(".amt").each(function(){
			sub_total = sub_total + ($(this).html() * 1);
		})
		$("#sub_total").val(sub_total);
		net_total = sub_total - discount;
		$("#net_total").val(net_total);
		$("#discount").val(discount);

	}


	$("#discount").keyup(function(){
		var discount = $(this).val();
		calculate(discount,0);
	})

	/// inserting order forms

	$("#order_form").click(function(){
		
		$.ajax({
			url: DOMAIN+"/includes/process.php",
			method: "POST",
			data: $("#get_order_data").serialize(),
			success: function(data){
				alert("data success");
			}
		})

	})
	





});