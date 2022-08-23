<html>
    <?php require_once "paymentConfig.php"; 
    session_start();
    
    $total_price = $_SESSION['totalPrice'];

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

    echo "You have paid";

    ?>
</html>