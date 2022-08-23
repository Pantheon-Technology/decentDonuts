<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">

<body class="brown">
<?php include_once "header.php";
$basketTotal = 0;
?>
	

	<div class="container">
		<div class="col-md-12">
			<div class="row show_cart my-5">
			</div>
		</div>
        <a href="cart.php" class="w3-button w3-round darkBrown w3-center">Proceed to Checkout</a>
        <h2>Items in basket</h2>
        <h2 id="basketTotal-el"><?php $basketTotal ?></h2>
	    </div>

<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>

<script type="text/javascript">
	
	$(document).ready(function(){
      
    show_cart();

	function show_cart(){
		$.ajax({
           method: "POST",
           url:"show_cart.php",
           success:function(data){
             $(".show_cart").html(data);
           }
		});	
	}


    $(document).on("click",".add",function(){
         var id = $(this).attr("id");
         var name = $("#name"+id+"").val();
         var price = $("#price"+id+"").val();
         var quantity = $("#quantity"+id+"").val();

         $.ajax({
            method:"POST",
            url: "add_to_cart.php",
            data:{id:id,name:name,price:price,quantity:quantity},
            success:function(data){
                const basketEl = document.getElementById("basketTotal-el").innerText;
                basketEl.innerText  += quantity;
            }
         });
    });
	
	});

</script>