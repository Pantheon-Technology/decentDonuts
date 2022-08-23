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
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
</head>
<body class="brown">
<?php include_once "header.php"; ?>


<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
 <!-- Header -->
 <header class="w3-display-container w3-content w3-wide" style="max-width:1500px;">
  <img class="w3-image" src="Pictures/mainPicture.jpg" alt="mainDonut" width="1500" height="700">
  <div class="w3-display-middle w3-margin-top w3-center">
    <img src="Pictures/Logo.jpg" alt="logo" style="width:40%">
  </div>
</header>

  <!-- First Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center lightBrown w3-round w3-margin-top" id="food">
    <div class="w3-quarter">
      <img src="Pictures/donut1.jpg" alt="First Donut" style="width:100%">
      <h3>Donut 1</h3>
      <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
      <span>
        £5.00
        </span>
    </div>
    <div class="w3-quarter">
      <img src="Pictures/donut2.jpg" alt="Second Donut" style="width:100%">
      <h3>Donut 2</h3>
      <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
      <span>
        £5.00
        </span>
    </div>
    <div class="w3-quarter">
      <img src="Pictures/donut3.jpg" alt="Third Donut" style="width:100%">
      <h3>Donut 3</h3>
      <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
      <span>
        £5.00
        </span>
    </div>
    <div class="w3-quarter">
      <img src="Pictures/donut4.jpg" alt="Fourth Donut" style="width:100%">
      <h3>Donut 4</h3>
      <p>Just some random text, lorem ipsum text praesent tincidunt ipsum lipsum.</p>
      <span>
        £5.00
        </span>
    </div>
  </div>
  
  <!-- Footer -->
  <footer class="w3-row-padding w3-padding-32 lightPink w3-round w3-margin-top">
    <div class="w3-third">
      <h3>Decent Donuts</h3>
      <ul>
        <li>🍩 Fresh Coffee, Donuts & Sweet Treats</li>
        <li>❤️ Proudly independant</li>
        <li>🕰 WED-SUN 12-5</li>
        <li>🥳 FRIDAY/SAT 12-8</li>
      </ul>
    </div>
  
    <div class="w3-third">
      <h3>Instagram Posts</h3>
      <ul class="w3-ul w3-hoverable">
        <li class="w3-padding-16">
          <img src="Pictures/donut.webp" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Lorem</span><br>
          <span>Sed mattis nunc</span>
        </li>
        <li class="w3-padding-16">
          <img src="Pictures/donut.webp" class="w3-left w3-margin-right" style="width:50px">
          <span class="w3-large">Ipsum</span><br>
          <span>Praes tinci sed</span>
        </li> 
      </ul>
    </div>

    <div class="w3-third w3-serif">
    <h3>Contact Us</h3>
    <p class="w3-xlarge">
    <a class="w3-button w3-round w3-margin"href="https://www.facebook.com/Decent.donuts/" target="_blank"><i class="fa fa-facebook-official w3-hover-opacity"></i>
    <a class="w3-button w3-round w3-margin" href="https://www.instagram.com/decent.donuts/" target="_blank"><i class="fa fa-instagram w3-hover-opacity"></a></i>
    <a class="w3-button w3-round w3-margin" href="mailto:decent.donuts@gmail.com/?subject=I got your email from your webpage!" target="_blank"><i class="fa fa-envelope w3-hover-opacity"></a></i>
      
  </p>
    </div>
  </footer>

<!-- End page content -->
</div>

<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>

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
            	alert("you have add new item");
            }
         });
    });
	
	});

</script>

</body>
</html>