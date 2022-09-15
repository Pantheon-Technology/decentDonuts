<?php 

include("config.php");
session_start();



$query = "SELECT * FROM items"; 
$res = mysqli_query($conn,$query);

$output = " ";


  if (mysqli_num_rows($res) < 1) {
  	$output .= "No Item";
  }

$count = 0;
  while ($row = mysqli_fetch_array($res)) {

    if ($row['quantity'] != 0) {

  	 $output .= "<div class='col-md-3 shadow-sm'>
        <img src='Pictures/".$row['image']."' style='height:250px;width:100%;'>
        <h5 class='text-center'>".$row['name']."</h5>
        <h5 class='text-center'>$".$row['price']."</h5>
        <input type='hidden' name='price' id='price".$row['id']."' value='".$row['price']."'>
        <input type='hidden' name='name' id='name".$row['id']."' value='".$row['name']."'>
        <input type='number' min = 0 max = ".$row['quantity']." name='quantity' id='quantity".$row['id']."' class='form-control' value='1'>

        <input type='submit' name='add_to_cart' class='btn btn-warning my-2 add' value='Add To cart' id='".$row['id']."' style='margin-left:55px;'>


  	 </div>";
     $count++;
  }
  	   
  }
    if ($count == 0){
      $output = "<h1>No Donuts Available</h1>";
    }


 echo $output;


 ?>