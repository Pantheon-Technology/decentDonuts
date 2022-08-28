<html>
    <?php require_once "paymentConfig.php"; 
    session_start();
    
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


    if (isset($_SESSION['isDelivery'])){
        //save delivery info
    }
    //save order info
    //- loop through all the cart and add to the order table

    session_destroy();

    echo '<script>alert("Order Successful. Your order number is: "); window.location.href = "index.php";</script>';
    ?>

</html>