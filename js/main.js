$(document).ready(function(){
	var DOMAIN = "http://localhost/dickson";
	$("#register_form").on("submit",function(){
		var status=false;
		var name =$("#username");
		var email=$("#email");
		var pass1=$("#password1");
		var pass2=$("#password2");
		var type=$("#usertype");
		var e_patt = new RegExp(/^[a-z0-9_-]+(\.[a-z0-9_-]+)*@[a-z0-9_-]+(\.[a-z0-9_-]+)*(\.[a-z]{2,4})$/);

		if (name.val()=="" || name.val().length<6) {
			name.addClass("border-danger");
			$("#u_error").html("<span class='text-danger'>Please Enter Name and Name should be more than 6 characters</span>");
			status=false;
		}else{
			name.removeClass("border-danger");
			$("#u_error").html("");
			status=true;
		}

		if (!e_patt.test(email.val())) {
			email.addClass("border-danger");
			$("#e_error").html("<span class='text-danger'>Enter valid Email</span>");
			status=false;
		}else{
			email.removeClass("border-danger");
			$("#e_error").html("");
			status=true;
		}

		if (pass1.val()=="" || pass1.val().length<4) {
			pass1.addClass("border-danger");
			$("#p1_error").html("<span class='text-danger'>Password should be more than 5 characters</span>");
			status=false;
		}else{
			pass1.removeClass("border-danger");
			$("#p1_error").html("");
			status=true;
		}

		if (pass2.val()=="" || pass2.val().length<4) {
			pass2.addClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password should be more than 5 characters</span>");
			status=false;
		}else{
			pass1.removeClass("border-danger");
			$("#p2_error").html("");
			status=true;
		}


		if (type.val()=="") {
			type.addClass("border-danger");
			$("#t_error").html("<span class='text-danger'>Please Enter usertype</span>");
			status=false;
		}else{
			type.removeClass("border-danger");
			$("#t_error").html("");
			status=true;
		}

		if ((pass1.val()==pass2.val()) && status== true) {

			$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#register_form").serialize(),
				success : function(data){
					if (data == "EMAIL_ALREADYEXIST") {
						alert("It seems like you email is already used");
					}else if(data == "SOME_ERROR"){
						alert("Something Wrong");
					}else{
						window.location.href= DOMAIN+"/index.php";
					}
				}
			})

		}else{
			pass2.removeClass("border-danger");
			$("#p2_error").html("<span class='text-danger'>Password do not match</span>");
			status=true;
		}

	
	})


//login javascript session

		$("#form_login").on("submit", function(){

			var log_email = $("#log_email");
			var log_pass = $("#log_password");
			var status = false;

			if (log_email.val()=="") {
				log_email.addClass("border-danger");
				$("#e_error").html("<span class='text-danger' >Enter Your Email Address</span>");
				status = false;
			}else{
				log_email.removeClass("border-danger");
				$("#e_error").html("");
				status = true;

			}


			if (log_pass.val()=="") {
				log_pass.addClass("border-danger");
				$("#p_error").html("<span class='text-danger' >Enter Your password</span>");
				status = false;
			}else{
				log_pass.removeClass("border-danger");
				$("#p_error").html("");
				status = true;
			}

			if (status) {

				$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#form_login").serialize(),
				success : function(data){
					if (data == "NOT_REGISTED") {
					log_email.addClass("border-danger");
					$("#e_error").html("<span class='text-danger' >It seems you are not registered</span>");
					}else if(data == "PASSWORD_DONTMATCH"){
					log_pass.addClass("border-danger");
					$("#p_error").html("<span class='text-danger' >Enter Your correct password</span>");
					status = false;
					}else{
						
						console.log(data);
						window.location.href= DOMAIN+"/dashboard.php";

					}
				}
			})	


			}


		})



		// add category javascrpit session

		$("#category_form").on("submit",function(){

			var cat_name = $("#category_name");

			if (cat_name.val()=="" || cat_name.val().length<4) {
				cat_name.addClass("border-danger");
				$("#cat_error").html("<span class= 'text-danger' >Enter Category Name</span>");
			}else{

				$.ajax({

					url: DOMAIN+"/includes/process.php",
					method: "POST",
					data: $("#category_form").serialize(),
					success: function(data){
						if (data=="NAME_ALREADY_EXIST") {

				cat_name.addClass("border-danger");
				$("#cat_error").html("<span class='text-danger'>Category Name Exist...!!</span>");
				$("#category_name").val("");

						}else{
				cat_name.removeClass("border-danger");
				$("#cat_error").html("<span class='text-success'>Category Successfuly Added...!!</span>");
				$("#category_name").val("");
						}
					}
				})
			}



		})



	manageCategory(1);
	function manageCategory(){
		$.ajax({
			url : DOMAIN+"/includes/process.php",
			method : "POST",
			data : {manageCategory:1},
			success : function(data){
				var choose = "<option value=''>Choose Category</option>";
				$("#get_category").html(data);
				$("#select_cat").html(choose+data);


			}
		})
	}



	$("#product_form").on("submit",function(){
		$.ajax({
				url : DOMAIN+"/includes/process.php",
				method : "POST",
				data : $("#product_form").serialize(),
				success : function(data){
					if (data == "NEW_PRODUCT_ADDED") {
						alert("New Product Added Successfully..!");
						$("#product_name").val("");
						$("#product_price").val("");
						$("#product_qty").val("");
						$("#product_price").val("");
						$("#product_cost").val("");
						$("#select_cat").val("");
						$("#expire_date").val("");
						$("#pro_date").val("");
						
						

					}else{
						console.log(data);
						alert(data);
					}
						
				}
			})
	})



	// add customer javascrpit session

		$("#customer_form").on("submit",function(){

			var cust_name = $("#cust_name");
			var c_contact = $("#c_contact");
			var c_location = $("#c_location");
			var status = false;

			if (cust_name.val()=="" || cust_name.val().length<4) {
				cust_name.addClass("border-danger");
				$("#cust_error").html("<span class= 'text-danger' >Enter Customer Name</span>");
				status = false;
			}else{
				cust_name.removeClass("border-danger");
				$("#cust_error").html("");
				status= true;

			}
		
			if (c_contact.val()=="" || c_contact.val().length<9) {
				c_contact.addClass("border-danger");
				$("#contact_error").html("<span class= 'text-danger' >Enter Customer Contact</span>");
				status = false;
			}else{
				c_contact.removeClass("border-danger");
				$("#contact_error").html("");

			}

			if (c_location.val()=="" || c_location.val().length<4) {
				c_location.addClass("border-danger");
				$("#location_error").html("<span class= 'text-danger' >Enter Customer Location</span>");
				status= false;

			}else{
				c_location.removeClass("border-danger");
				$("#location_error").html("");
				status=true;
			}

			if (status) {

				$.ajax({
					url: DOMAIN+'./includes/process.php',
					method: "POST",
					data: $("#customer_form").serialize(),
					success: function(data){
						if (data=="CUSTOMER_EXIST") {

				cust_name.addClass("border-danger");
				$("#cust_error").html("<span class='text-danger'>Customer Name Exist...!!</span>");
				$("#cust_name").val("");

						}else{
				cust_name.removeClass("border-danger");
				$("#cust_error").html("<span class='text-success'>Customer Name Successfuly Added...!!</span>");
				$("#cust_name").val("");
				$("#c_contact").val("");
				$("#c_location").val("");
						}
					}
				})

			}

		})




})