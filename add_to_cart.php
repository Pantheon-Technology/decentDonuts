<?php 

session_start();

$item_array = array(
       "id" => $_POST['id'],
       "name" => $_POST['name'],
       "price" => $_POST['price'],
       "quantity" => $_POST['quantity']
);

       $id = $_POST['id'];
       if (empty($_SESSION['cart'][$id])) {
              $_SESSION['cart'][$id] = $item_array; 
       } else {
              $_SESSION['cart'][$id]['quantity'] +=  $_POST['quantity'];
       };
       $_SESSION['quantity'] += $_POST['quantity'];
 ?>