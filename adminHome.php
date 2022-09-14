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
<?php include_once "config.php"; ?>
<body class="brown">
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left lightPink" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a href="adminHome.php" onclick="w3_close()" class="w3-bar-item w3-button">Home</a>
  <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="lightPink w3-xlarge w3-animate-zoom" style="max-width:2000px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-center w3-padding-16">Decent Donuts</div>
  </div>
</div>


<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding w3-animate-right" style="max-width:1200px;margin-top:70px">

  <!-- First Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center lightBrown w3-round w3-margin-top" id="food">
  <?php
      
$sql = "SELECT * FROM orders INNER JOIN itemOrder ON orders.orderId = itemOrder.orderId";
$result = $conn->query($sql);
// if there is are more than 0 rows....
if ($result->num_rows > 0) {
 // ....output data of each row
 $curId = "x";
  while($row = $result->fetch_assoc()) {
  // formatting for output data
  $id = $row['orderId'];
    if ($curId == "x"){
      $curId = $id;
      $printString = "Customer has ordered: " . $row["quantity"] . "x" . $row["donutId"];
    } else {
      if($curId != $id){
        echo "<div class=" . "w3-quarter w3-animate-zoom" . "> <p>" . $printString . "</div>";
        $curId = $id;
        $printString = "Customer has ordered: " . $row["quantity"] . "x" . $row["donutId"];
      } else {
        $printString .= ", " . $row["quantity"] . "x" . $row["donutId"];
      }
    }
  }
  echo "<div class=" . "w3-quarter w3-animate-zoom" . "> <p>" . $printString . "</div>";

} else {
  //if no data in the table matched the sql query, display this message
  echo "There are no orders right now.";
}
?>
  </div>
  
<!-- End page content -->
</div>
</body>
</html>
<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>