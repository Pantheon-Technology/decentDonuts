<html>
<meta charset="UTF-8">
<?php require_once "paymentConfig.php";
session_start();

$total_price = $_SESSION['totalPrice'];

if (isset($_POST['stripeToken'])) {

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
require_once "config.php";
$sql1 = "SELECT count(*) as total FROM `orders`;";
$result = $conn->query($sql1);
$data = $result->fetch_assoc();
$orderID = $data['total'] + 1;

$paid = $_SESSION['paid'];
$orderStatus = 1;
$deliver = isset($_SESSION['isDelivery']) == TRUE ? TRUE : FALSE;

if ($_SESSION['isDelivery'] == True) {
    $detailsArray = $_SESSION['delDet'];
    $post = $detailsArray['post'];
    $customerName = $detailsArray['name'];
    $houseNum = $detailsArray['num'];
    $phoneNum = $detailsArray['phone'];

    $sql2 = "INSERT INTO `orders` (`orderId`, `customerName`, `phoneNumber`, `roomNumber`, `postcode`, `orderStatus`, `paid`, `isDelivery`) VALUES (?,?,?,?,?,?,?,?);";
    if ($stmt = mysqli_prepare($conn, $sql2)) {
        mysqli_stmt_bind_param($stmt, "issisiii", $o, $cn, $pn, $hn, $po, $os, $p, $del);
        $o = $orderID;
        $cn = $customerName;
        $pn = $phoneNum;
        $hn = $houseNum;
        $po = $post;
        $os = $orderStatus;
        $p = $paid;
        $del = $deliver;
        if (!(mysqli_stmt_execute($stmt))) {
            echo "Error: " . $sql2 . "<br>" . $conn->error;
        }
    }
    mysqli_stmt_close($stmt);
} else {
    $sql3 = "INSERT INTO `orders` (`orderId`, `orderStatus`, `paid`, `isDelivery`)
    VALUES (?,?,?,?);";
    if ($stmt = mysqli_prepare($conn, $sql3)) {
        mysqli_stmt_bind_param($stmt, "iiii", $o, $os, $p, $del);
        $o = $orderID;
        $os = $orderStatus;
        $p = $paid;
        $del = $deliver;
        if (!(mysqli_stmt_execute($stmt))) {
            echo "Error: " . $sql3 . "<br>" . $conn->error;
        }
    }
    mysqli_stmt_close($stmt);
}

foreach ($_SESSION['cart'] as $key => $value) {
    $donutID = $value['id'];
    $quantity = $value['quantity'];

    $sql4 = "INSERT INTO `itemOrder` (`orderId`, `donutId`, `quantity`)
    VALUES (?,?,?);";
    if ($stmt = mysqli_prepare($conn, $sql4)) {
        mysqli_stmt_bind_param($stmt, "iii", $o, $d, $q);
        $o = $orderID;
        $d = $donutID;
        $q = $quantity;
        if (!(mysqli_stmt_execute($stmt))) {
            echo "Error: " . $sql4 . "<br>" . $conn->error;
        }
    }
    mysqli_stmt_close($stmt);

    $sql5 = "SELECT quantity FROM items WHERE id =" .$donutID.";";
    $result = $conn->query($sql5);
    if ($result->num_rows > 0) {
        while($row = $result->fetch_assoc()) {
            $quantityAll = $row['quantity'];
            $sql6 = "UPDATE items SET quantity = ? WHERE id = ?";
            if ($stmt = mysqli_prepare($conn, $sql6)) {
                mysqli_stmt_bind_param($stmt, "ii", $q, $i);
                $q = $quantityAll - $quantity;
                $i = $donutID;
                if (!(mysqli_stmt_execute($stmt))) {
                    echo "Error: " . $sql4 . "<br>" . $conn->error;
                }
            }
            mysqli_stmt_close($stmt);
        }
    }

}


session_destroy();
$conn->close();

echo '<script>alert("Order Successful. Your order number is: ' . $orderID . '"); window.location.href = "index.php";</script>';
?>

</html>