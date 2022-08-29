<html>
    <?php require_once "paymentConfig.php"; 
    session_start();

    $_SESSION['postcode'] = $details;
    $_SESSION['isDelivery'] = $deliveryBool;
    $_SESSION['name'] = $customerName;
    $_SESSION['num'] = $houseNum;
    $_SESSION['phone'] = $phoneNum;
    $_SESSION['post'] = $postcode;

    
    $total_price = $_SESSION['totalPrice'];

    if (isset($_POST['stripeToken'])){
        
    $token = $_POST['stripeToken'];
    $email = $_POST['stripeEmail'];

    $customer = \Stripe\Customer::create([
        'source' => $token,
        'email' => $email
    ]);

    $charge = \Stripe\Charge::create([
        "customer" => $customer->id,
        "amount" => $total_price * 100,
        "currency" => "gbp"
    ]);
    }

    //generate and check a order number

    //select count(all orders)
    //add one onto the end as the order id
    ?>

<?php
    require_once "config.php";
    $sql = "INSERT INTO orders (`customerName`, `phoneNumber`, `roomNumber`, `postcode`, `orderStatus`, `paid`, `isDelivery`)
    VALUES ($customerName, $phoneNum, $houseNum, $details, 1, 1, $deliveryBool)";
if ($conn->query($sql) === TRUE) {
  $last_id = $conn->insert_id;
  echo "New record created successfully. Last inserted ID is: " . $last_id;
} else {
  echo "Error: " . $sql . "<br>" . $conn->error;
}

if (isset($_SESSION['isDelivery'])){
    //save delivery info
}
//save order info
//- loop through all the cart and add to the order table

session_destroy();

echo '<script>alert("Order Successful. Your order number is: ");</script>';
?>
</html>