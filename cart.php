<!DOCTYPE html>
<html>
<head>
<title>Decent Donuts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="decentDonuts.css">
<link rel="icon" href="Pictures/LogoWithBackground.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
	
</head>
<body class="brown">
<?php include_once "header.php"; 
$hidden = isset($_SESSION['quantity']) ? FALSE : TRUE;
?>

<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px;">
		<div class="col-md-12">
		<h1> Your Basket </h1>
			<table class="table table-bordered my-5 ">
				<tr>
					<th>ITEM ID</th>
					<th>ITEM NAME</th>
					<th>ITEM PRICE</th>
					<th>ITEM QUANTITY</th>
					<th>ACTION</th>
				</tr>

				<?php 

				$total_price = 0;

				if (!empty($_SESSION['cart'])) {
					$itemID = [];
					foreach ($_SESSION['cart'] as $key => $value) { 
					
					?>
				
						<tr>
							<td><?php echo $value['id']; ?></td>
							<td><?php echo $value['name']; ?></td>
							<td><?php echo $value['price']; ?></td>
							<td><?php echo $value['quantity']; ?></td>
                             <td>
                             	<button class="btn btn-danger remove" id="<?php echo $value['id']; ?>" >Remove</button>
                             </td>
						</tr>

						  <?php $total_price = $total_price + $value['quantity'] * $value['price']; 
						  	
						?>
						
					<?php }
						$_SESSION['totalPrice'] = $total_price;
				}else{ ?>
                       <tr>
                       	  <td class="text-center" colspan="5">NO ITEM SELECTED</td>
                       </tr>
				<?php }




				 ?>

				 <tr>
							<td colspan="2"></td>
							<td>Total Price</td>
							<td><?php echo "£" . number_format($total_price,2); ?></td>
							<td>
							<?php
			if ($hidden == FALSE){
				echo '<button class="btn btn-warning clearall">Clear All</button>';
							};
							?>	
                             </td>
						</tr>
			</table>
			<?php
			if ($hidden == FALSE){
				$del = isset($_SESSION['isDelivery']) ? "moreDel.php" : "paymentOptions.php";
				echo '<a class="w3-round w3-button lightPink" id="checkout-btn" href=' . $del . '>Confirm basket</a>';
			};
			?>
			
		</div>
		<?php include_once "footer.php"; ?>
	</div>
<script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>


<script type="text/javascript">
	$(document).ready(function(){


		$(".remove").click(function(){
           var id = $(this).attr("id");
                
                var action = "remove";

             $.ajax({
               method:"POST",
               url:"action.php",
               data:{action:action,id:id},
               success:function(data){
				window.location.reload();
               }
            });
		});
        

        $(".clearall").click(function(){
              
              var action = "clear";

            $.ajax({
               method:"POST",
               url:"action.php",
               data:{action:action},
               success:function(data){
				window.location.reload();
               }
            });
        });
	});
</script>
</body>
</html>