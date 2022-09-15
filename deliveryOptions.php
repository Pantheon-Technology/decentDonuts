<html>
    <?php include_once "header.php";
    $open = True;
    if (date('w') != 1 || date('w') != 2){
        if (date('w') > 4){
            if (date('H') < 12 || date('H') > 20){
                $open = False;
            }
        } else {
            if (date('H') < 12 || date('H') > 20){
                $open = False;
            }
        }
    } else {
        $open = False;
    };

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST['pick'])){
            $_SESSION['isDelivery'] = False;
        header('location: order.php');
        } else {
            $_SESSION['isDelivery'] = True;
        header('location: deliveryDetails.php');
        }
    }
    ?>
</head>
<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<div class="w3-center">
    <?php 
    if ($open == True){
    echo '<form method = "post"><h1>Choose a delivery method</h1>
    <button class ="w3-button w3-round lightPink" name = "pick" type="submit">Pick up in store</button>
    <button class ="w3-button w3-round lightPink" type="submit">Deliver to my address</button></form>';
    } else {
        echo '<h1>The store is currently not open</h1>';
    }
    ?>
    <?php include_once "footer.php"; ?>
</div>
</body>