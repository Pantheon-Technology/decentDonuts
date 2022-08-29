<html>
    <?php include_once "config.php";
         include_once "footer.php"; 
session_start();
$postcodes = array('L15', 'L18', 'L17', 'L16', 'L13', 'L8', 'L7', 'L19', 'L14', 'L25', 'L6', 'L69', 'L3', 'L1', 'L71', 'L75', 'L70', 'L12', 'L74', 'L5', 'L36', 'L26', 'L27', 'L4', 'L2', 'L11');
// Processing form data when form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $post = strtoupper(substr(trim($_POST['postcode']), 0, -4));
    if (in_array($post, $postcodes)) {
        $details = array("Postcode" => $_POST['postcode']);
        $_SESSION['postcode'] = $details;
        $_SESSION['isDelivery'] = True;
        header('location: order.php');
    } else {
        echo '<script>alert("You are too far away"); window.location.href = "index.php";</script>'; 
    }
};
 include_once "header.php"; ?>

<body class="brown">
<div class="w3-main w3-content w3-padding" style="max-width:1200px;margin-top:70px">
<form method = "post" id = "postcode_element"> 

    <label for="postcode">Postcode</label>
    <input type = "text" required name = "postcode" id = "postcode"><br>

    <button class ="w3-button w3-round lightPink" type="submit">Proceed to Order</button>
    <input type="reset"> 
</form>
</div>
</body>
</html>