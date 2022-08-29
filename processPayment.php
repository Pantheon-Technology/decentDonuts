<html>
    <head>
        <title>Stripe Payment </title>
        <?php include_once "header.php"; ?>
    </head>
<body class="brown">
    <?php require_once "paymentConfig.php"; session_start(); 
    if (isset($_SESSION['isDelivery'])){
        if ($_SESSION['quantity'] % 3 == 0) {
            $mod = ($_SESSION['quantity'] / 3) * 0.5;
        }
        $deliveryCharge = $_SESSION['totalPrice'] + $mod;
        $_SESSION['totalPrice'] = $deliveryCharge;
    }
    $total_price = $_SESSION['totalPrice'];
    
    ?>
    <div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<div class="w3-center">
    <form action="successfulPayment.php" method="post">
    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
         data-key="<?php echo $test_keys['publishable_key']; ?>"
        data-name="Decent Donuts Online Payment"
        data-description="Payment API for Decent Donuts"
        data-image="Pictures/Logo.jpg"
        data-amount="<?php echo $total_price * 100; ?>"
        data-currency="gbp"
        data-email="myles.hoult@pantheontechnology.co.uk">

        </script>
    </form>
</div>
<?php include_once "footer.php"; ?>
</div>
</body>
</html>