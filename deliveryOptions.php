<html>
    <?php include_once "header.php";
    $open = True;
    if (date('w') != 1 && date('w') != 2){
        if (date('w') > 4){
            if (date('H') < 12 || date('H') > 20){
                $open = False;
            }
        } else {
            if (date('H') < 12 || date('H') > 17){
                $open = False;
            }
        }
    } else {
        $open = False;
    };
    ?>
</head>
<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<div class="w3-center">
    <?php 
    if ($open == True){
    echo '<h1>Choose a delivery method</h1>
    <a href="order.php" class="w3-button w3-round lightPink">Pick up in store</a>
    <a href="deliveryDetails.php" class="w3-button w3-round pink">Deliver to my address</a>';
    } else {
        echo '<h1>The store is currently not open</h1>';
    }
    ?>
</div>
</body>