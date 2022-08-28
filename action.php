<?php 
  session_start();


  if (isset($_POST['action'])) {
  	  if ($_POST['action'] == "clear") {
  	  	    unset($_SESSION['cart']);
			unset($_SESSION['quantity']);
  	  }


  	  if ($_POST['action'] == "remove") {
  	  	  foreach ($_SESSION['cart'] as $key => $value) {
  	  	  	  if ($value['id'] == $_POST['id']) {
				$_SESSION['quantity'] -= $_SESSION['cart'][$key]['quantity'];
  	  	  	  	unset($_SESSION['cart'][$key]);
  	  	  	  }
  	  	  }
		  if ($_SESSION['quantity'] == 0) {
			unset($_SESSION['quantity']);
		}
  	  }
  }



 ?>