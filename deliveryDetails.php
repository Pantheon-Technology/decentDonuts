<html>
    <?php include_once "config.php"; 
session_start();

// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $details = array("Name" => $_POST['fname'], "Line1" => $_POST['lineOne'], "TownCity" => $_POST['townCity'], "Postcode", $_POST['postcode'], "phone", $_POST['phone']);
    $_SESSION['deliveryDetails'] = $details;
    }

?>
<?php include_once "header.php"; ?>

<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<form method = "post"> 
    <label for="fname">Full name:</label>
    <input type = "text" required  name = "fname" id = "fname"><br>

    <label for="lineOne">Address Line 1</label>
    <input type = "text" required name = "lineOne" id = "lineOne"><br>

    <label for="townCity">Town/City</label>
    <input type = "text" required name = "townCity" id = "townCity"><br>

    <label for="postcode">Postcode</label>
    <input type = "text" required name = "postcode" id = "postcode"><br>

    <label for="phone">Phone Number</label>
    <input type = "text" required name = "phone" id = "phone"><br>


    <a href="processPayment.php" class ="w3-button w3-round lightPink" type="submit">Proceed to Payment</a>
    <input type="reset"> 


</form>
</div>
</body>
</html>