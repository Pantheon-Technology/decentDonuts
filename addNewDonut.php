<!DOCTYPE html>
<html>
<head>
<title>Decent Donuts</title>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Karma">
<link rel="stylesheet" href="decentDonuts.css">
<link rel="icon" href="Pictures/LogoWithBackground.png">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<style>
body,h1,h2,h3,h4,h5,h6 {font-family: "Karma", sans-serif}
.w3-bar-block .w3-bar-item {padding:20px}
</style>
</head>
<?php include_once "config.php"; ?>
<body class="brown">
<nav class="w3-sidebar w3-bar-block w3-card w3-top w3-xlarge w3-animate-left lightPink" style="display:none;z-index:2;width:40%;min-width:300px" id="mySidebar">
  <a href="javascript:void(0)" onclick="w3_close()"
  class="w3-bar-item w3-button">Close Menu</a>
  <a class="w3-bar-item w3-button" href="adminViewOrders.php">View Orders</a>
  <a class="w3-bar-item w3-button" href="addNewDonut.php">Add New Donut</a>
  <a class="w3-bar-item w3-button" href="adminUpdateQuantities.php">Update Quantities</a>
  <a class="w3-bar-item w3-button" href="logout.php">Logout</a>
</nav>

<!-- Top menu -->
<div class="w3-top">
  <div class="lightPink w3-xlarge w3-animate-zoom" style="max-width:2000px;margin:auto">
    <div class="w3-button w3-padding-16 w3-left" onclick="w3_open()">☰</div>
    <div class="w3-center w3-padding-16">Decent Donuts</div>
  </div>
</div>


<!-- !PAGE CONTENT! -->
<div class="w3-main w3-content w3-padding w3-animate-right" style="max-width:1200px;margin-top:70px">

  <!-- First Photo Grid-->
  <div class="w3-row-padding w3-padding-16 w3-center lightBrown w3-round w3-margin-top" id="food">
  <?php

$sql = "SELECT * FROM items";

$result = $conn->query($sql);
if ($result->num_rows > 0) {
  while($row = $result->fetch_assoc()) {
    echo "<p>" . $row['id'] . "|" . $row['name'] . "|" . $row['price']."</p>";
  }
}

include_once "config.php"; 
session_start();
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $donutImg = $donutName = $donutPrice = $error = "";
  $target_dir = "Pictures/";
  $target_file = $target_dir . basename($_FILES["fileToUpload"]["name"]);
  $uploadOk = 1;
  $imageFileType = strtolower(pathinfo($target_file,PATHINFO_EXTENSION));


    $check = getimagesize($_FILES["fileToUpload"]["tmp_name"]);
    if($check !== false) {
      $uploadOk = 1;
    } else {
      echo "File is not an image.";
      $uploadOk = 0;
    }

  if (file_exists($target_file)) {
    echo "Sorry, file already exists.";
    $uploadOk = 0;
  }

  if ($_FILES["fileToUpload"]["size"] > 500000) {
    echo "Sorry, your file is too large.";
    $uploadOk = 0;
  }

  if($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg") {
    echo "Sorry, only JPG, JPEG & PNG files are allowed.";
    $uploadOk = 0;
  }

  // Check if $uploadOk is set to 0 by an error
if ($uploadOk == 0) {
    echo "Sorry, your file was not uploaded.";
    $error = "File Upload Error";
  // if everything is ok, try to upload file
  } else {
    if (move_uploaded_file($_FILES["fileToUpload"]["tmp_name"], $target_file)) {
      $donutImg = htmlspecialchars( basename( $_FILES["fileToUpload"]["name"]));
    } else {
      echo "Sorry, there was an error uploading your file.";
    }
  }

// Processing form data when form is submitted

    // Validate username
    if (empty(trim($_POST["donutName"]))) {
        $error = "Please enter a name for the donut.";
    } else {
        // Prepare a select statement
        $sql = "SELECT id FROM items WHERE `name` = ?";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_donutName);

            // Set parameters to be bound
            $param_donutName = trim($_POST["donutName"]);

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // store the result of the excuting statement
                mysqli_stmt_store_result($stmt);
                // checks if the username already exists
                if (mysqli_stmt_num_rows($stmt) > 0) {
                    $error = "This donut name has been taken, please use another";
                } else {
                    $donutName = trim($_POST["donutName"]);
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }

    if (empty(trim($_POST["donutPrice"]))) {
      $error = "Please enter a price for the donut.";
    } else {
      $donutPrice = trim($_POST["donutPrice"]);
    }

    // Check input errors before inserting in database
    if (empty($error)) {

        // Prepare an insert statement, inserts the information into the adminaccount table in the database
        $sql = "INSERT INTO items (`name`, price ,`image`) VALUES (?, ?, ?)";

        if ($stmt = mysqli_prepare($conn, $sql)) {
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_donutName, $param_donutPrice, $param_donutImg);

            // Set parameters to be bound
            $param_donutName = $donutName;
            $param_donutPrice = $donutPrice;
            $param_donutImg =  $donutImg;

            // execute the prepared statement
            if (mysqli_stmt_execute($stmt)) {
                // Redirect to HOME page once account has been created
                header("Refresh:0");
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    } else {
      echo $error;
    }

    // Close connection
    mysqli_close($conn);
}
?>



<form method="post" enctype="multipart/form-data">
    <input class="w3-input w3-margin-bottom" style="width:20%" placeholder="Donut Name" input type="text" name="donutName">
    <input class="w3-input w3-margin-bottom" style="width:20%" placeholder="Donut Price" input type="text" name="donutPrice">
    <input type="file" name="fileToUpload" id="fileToUpload"></p>
  <button class="w3-button w3-black w3-margin-bottom" input type="submit">Upload Donut</button>
  </div>
</form>
  
<!-- End page content -->
</div>
</body>
</html>
<script>
// Script to open and close sidebar
function w3_open() {
  document.getElementById("mySidebar").style.display = "block";
}
 
function w3_close() {
  document.getElementById("mySidebar").style.display = "none";
}
</script>