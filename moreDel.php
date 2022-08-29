<html>
    <?php include_once "config.php";
 include_once "header.php"; 
 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $_SESSION['delDet'] = array ("name" => $_POST['name'], "num" => $_POST['roomNum'], "phone" => $_POST['phone'], "post" => $_SESSION['postcode']);
    $_SESSION['name'] = $_POST['name'];
    $_SESSION['num'] = $_POST['roomNum'];
    $_SESSION['phone'] = $_POST['phone'];
    $_SESSION['post'] = $_POST['postcode'];
    header('location: paymentOptions.php');
 }
 ?>

<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<form method = "post"> 

<label for="fname">Full name:</label>
    <input type = "text" required  name = "name" id = "name"><br>

    <label for="lineOne">House/Room/Building Number</label>
    <input type = "text" required name = "roomNum" id = "roomNum"><br>

    <label for="phone">Phone Number</label>
    <input type = "text" required name = "phone" id = "phone"><br>
    
    <button class ="w3-button w3-round lightPink" type="submit">Proceed to Order</button>
    <input type="reset"> 
</form>
<?php include_once "footer.php"; ?>
</div>
</body>
</html>