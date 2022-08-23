<html>
    <head>
        <title>Stripe Payment </title>
        
    </head>
<body>
    <?php require_once "paymentConfig.php"; session_start(); 
    $total_price = $_SESSION['totalPrice'];
    
    ?>
    <form action="successfulPayment.php" method="post">
    <script type="text/javascript" src="https://checkout.stripe.com/checkout.js" class="stripe-button"
         data-key="<?php echo $test_keys['publishable_key']; ?>"
        data-name="Online Payment"
        data-description="Payment API"
        data-image="Pictures/Logo.jpg"
        data-amount="<?php echo $total_price * 100; ?>"
        data-currency="gbp"
        data-email="myles.hoult@pantheontechnology.co.uk">

        </script>
    </form>
</body>
</html>