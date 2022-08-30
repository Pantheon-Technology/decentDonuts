<html>
    <?php include_once "header.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['online'])) {
        $_SESSION['paid'] = True;
        header('location: processPayment.php');
    } else {
        $_SESSION['paid'] = False;
        header('location: successfulPayment.php');
    }
}
    ?>
</head>
<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<div class="w3-center">
    <?php 
   
    echo '<h1>Choose a Payment method</h1>
    <form method = "post"> 
    <button name="online" class="w3-button w3-round lightPink">Card (Online)</button>
    <button class="w3-button w3-round pink">Pay Upon Arrival</button></form>';
    ?>
    <?php include_once "footer.php"; ?>
</div>
</body>